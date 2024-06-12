<?php

namespace App\Http\Controllers;

use App\DataTables\GaleriDataTable;
use App\Http\Requests\GaleriRequest;
use App\Models\Galeri;
use App\Models\KategoriLayanan;
use Illuminate\Http\Request;


class GaleriController extends Controller
{
    public function display()
    {
        $kategoris = KategoriLayanan::orderBy('name')->get();

        if (request('kategori')) {
            $kategori = KategoriLayanan::firstWhere('identifier', request('kategori'));
            $title = ' in ' . $kategori->name;
        }
        $title = '';

        $pagination = Galeri::latest()->filter(request(['search', 'kategori']))->paginate(8)->withQueryString();

        return view('galeri', [
            'galeri' => $pagination,
            'galeri_kategori' => $kategoris,
            'title' => 'Galeri' . $title,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GaleriDataTable $datatable)
    {
        return $datatable->render('store.galeri');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.galeriAction', [
            'galeri' => new Galeri(),
            'kategori' => KategoriLayanan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GaleriRequest $request)
    {
        $data = $request->all();
        $data['thumbnail'] = galeriPath($request);
        Galeri::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menambahkan data!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit(Galeri $galeri)
    {
        return view(
            'store.galeriAction',
            [
                'kategori' => KategoriLayanan::all()
            ],
            compact('galeri')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(GaleriRequest $request, Galeri $galeri)
    {
        $galeri->category_id = $request->category_id;
        $galeri->thumbnail = galeriPath($request);
        $galeri->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galeri $galeri)
    {
        $galeri->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
