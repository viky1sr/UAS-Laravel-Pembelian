<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Http\Requests\KategoriUpdateRequest;
use App\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori.index')->with('categories', Kategori::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {
        Kategori::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Kategori telah berhasil di buat');

        return redirect(route('kategori.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.create')->withKategori($kategori);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriUpdateRequest $request, Kategori $kategori)
    {
        $data = $request->only('name');

        $kategori->update($data);

        session()->flash('success', 'Kategori telah berhasil di rubah');

        return redirect(route('kategori.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {

        if ($kategori->produks->count() > 0) {
            session()->flash('error', 'Kategori gagal terhapus karena ada produk yang yg termasuk dalam kategori ini.');

            return back();
        }

        $kategori->delete();

        session()->flash('success', 'Kategori telah berhasil di hapus');

        return redirect(route('kategori.index'));
    }
}
