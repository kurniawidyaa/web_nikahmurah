<?php

namespace App\Http\Controllers;

use App\DataTables\PostDataTable;
use App\Http\Requests\PostRequest;
use App\Models\KategoriPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Str;

class PostController extends Controller
{
    public function display()
    {
        $kategoris = KategoriPost::orderBy('name')->get();
        $title = '';
        if (request('kategori')) {
            $kategori = KategoriPost::firstwhere('slug', request('kategori'));
            $title = ' in ' . $kategori->name;
        }

        $pagination = Post::latest()->filter(request(['search', 'kategori']))->paginate(4)->withQueryString();

        return view(
            'blog',
            [
                'posts' => $pagination,
                'kategoris' => $kategoris,
                'title' => 'Blog' . $title,
            ],
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostDataTable $datatables)
    {
        return $datatables->render('blog.post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'blog.postAction',
            [
                'post' => new Post(),
                'kategori' =>  KategoriPost::all(),
                // 'writer' => User::where('id')->first(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $slug = Str::slug($request->title);
        $post = $request->all();
        $post['author_id'] = Auth::User()->id;
        $post['slug'] = $slug;
        $post['thumbnail'] = postPath($request);
        Post::create($post);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menambahkan data!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        return view(
            'post',
            [
                'kategori' => KategoriPost::all(),
                'post' => $post,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view(
            'blog.postAction',
            [
                'kategori' => KategoriPost::all()
            ],
            compact('post')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $slug = Str::slug($request->title);

        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = $slug;
        $post->thumbnail = postPath($request);
        $post->body = $request->body;
        $post->excerpt = $request->excerpt;
        // $post->published_at = $request->edited_at;
        $post->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
