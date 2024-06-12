<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriPostDataTable;
use App\Http\Requests\KategoriPostRequest;
use App\Models\KategoriPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KategoriPostDataTable $datatables)
    {
        return $datatables->render('blog.kategoriPost');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.kategoriPostAction', ['kategoriPost' => new KategoriPost()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriPostRequest $request)
    {
        $kategori = $request->all();
        $slug = Str::slug($request->name);
        $kategori['slug'] = $slug;
        KategoriPost::create($kategori);


        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menambahkan data!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriPost  $kategoriPost
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriPost $kategoriPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriPost  $kategoriPost
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriPost $kategoriPost)
    {
        return view('blog.kategoriPostAction', compact('kategoriPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriPost  $kategoriPost
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriPostRequest $request, KategoriPost $kategoriPost)
    {
        $kategoriPost->name = $request->name;
        $kategoriPost->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Data Berhasil diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriPost  $kategoriPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriPost $kategoriPost)
    {
        $kategoriPost->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
