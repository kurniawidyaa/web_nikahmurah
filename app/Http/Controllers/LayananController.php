<?php

namespace App\Http\Controllers;

use App\DataTables\LayananDataTable;
use App\Http\Requests\LayananRequest;
use App\Models\KategoriLayanan;
use App\Models\Layanan;
use App\Models\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class LayananController extends Controller
{
    public function display()
    {
        $kategoris = KategoriLayanan::orderBy('name')->get();

        if (request('kategori')) {
            $kategori = KategoriLayanan::firstWhere('identifier', request('kategori'));
            $title = ' in ' . $kategori->name;
        }
        $title = '';

        $pagination = Layanan::latest()->filter(request(['search', 'kategori']))->paginate(6)->withQueryString();

        return view('layanan', [
            'layanan' => $pagination,
            'kategoris' => $kategoris,
            'submit' => 'Detail Paket',
            'title' => 'Layanan' . $title
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananDataTable $datatables)
    {
        return $datatables->render(
            'store.layanan',
            [
                'navigation' => Navigation::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.layananAction', [
            'layanan' => new Layanan(),
            'kategori' => KategoriLayanan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LayananRequest $request)
    {
        $identifier = Str::slug($request->name);
        $data = $request->all();
        $data['identifier'] = $identifier;
        $data['thumbnail'] = layananPath($request);
        Layanan::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menambahkan data!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function show($identifier)
    {
        $layanan = Layanan::where('identifier', $identifier)->first();
        return view(
            'layananDetail',
            [
                'layanan' => $layanan,
                'submit' => 'Pesan Sekarang'
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Layanan $layanan)
    {
        return view(
            'store.layananAction',
            [
                'kategori' => KategoriLayanan::all()
            ],
            compact('layanan')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function update(LayananRequest $request, Layanan $layanan)
    {
        $identifier = Str::slug($request->name);
        $layanan->category_id = $request->category_id;
        $layanan->name = $request->name;
        $layanan->identifier = $identifier;
        $layanan->thumbnail = layananPath($request);
        $layanan->description = $request->description;
        $layanan->note = $request->note;
        $layanan->qty = $request->qty;
        $layanan->price = $request->price;
        $layanan->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diupdate!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layanan  $layanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
