<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriLayananDataTable;
use App\Http\Requests\KategoriLayananRequest;
use App\Models\KategoriLayanan;
use Illuminate\Http\Request;

class KategoriLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KategoriLayananDataTable $datatables)
    {
        return $datatables->render('store.kategoriLayanan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.kategoriLayananAction', ['kategoriLayanan' => new KategoriLayanan()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriLayananRequest $request)
    {
        KategoriLayanan::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menambahkan data!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriLayanan  $kategoriLayanan
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriLayanan $kategoriLayanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriLayanan  $kategoriLayanan
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriLayanan $kategoriLayanan)
    {
        return view('store.kategoriLayananAction', compact('kategoriLayanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriLayanan  $kategoriLayanan
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriLayananRequest $request, KategoriLayanan $kategoriLayanan)
    {
        $kategoriLayanan->name = $request->name;
        $kategoriLayanan->identifier = $request->identifier;
        $kategoriLayanan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diubah.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriLayanan  $kategoriLayanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriLayanan $kategoriLayanan)
    {
        $kategoriLayanan->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
