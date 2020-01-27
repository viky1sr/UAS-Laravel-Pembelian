<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukRequest;
use App\Http\Requests\ProdukUpdateRequest;
use App\Kategori;
use App\Produk;

class ProdukController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produk.index')->with('produks', Produk::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create')->with('categories', Kategori::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukRequest $request)
    {
        Produk::create([
            'name' => $request->name,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori
        ]);

        session()->flash('success', 'Produk sukses dibuat.');

        return redirect(route('produk.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('produk.create')->withProduk($produk)->with('categories', Kategori::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukUpdateRequest $request, Produk $produk)
    {
        $data = $request->only('name', 'harga', 'stok', 'kategori_id');

        if ($request->kategori) {
            $produk->kategori()->associate($request->kategori);
        }

        $produk->update($data);

        session()->flash('success', 'Produk telah berhasil di update');

        return redirect(route('produk.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        if ($produk->orders->count() > 0) {
            session()->flash('error', 'Produk gagal terhapus karena ada produk yang yg masih di proses.');

            return back();
        }


        $produk->delete();

        session()->flash('success', 'Produk telah berhasil di hapus');

        return back();
    }

    public function destroyAll()
    {
        Produk::query()->delete();

        session()->flash('success', 'Semua produk telah berhasil di hapus');

        return back();
    }
}
