<?php

namespace App\Http\Controllers;

use App\Http\Requests\consumer\ConsumerCreateRequest;
use App\Consumer;
use App\Http\Requests\consumer\ConsumerRequest;
use App\Http\Requests\consumer\ConsumerUpdateRequest;

class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('consumer.index')->with('consumers', Consumer::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consumer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsumerCreateRequest $request)
    {
        Consumer::create([
            'nama_konsumer' => $request->nama_konsumer,
            'alamat' => $request->alamat
        ]);

        session()->flash('success', 'Consumer telah berhasil di buat');

        return redirect(route('consumer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Consumer  $Consumer
     * @return \Illuminate\Http\Response
     */
    public function show(Consumer $consumer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consumer  $Consumer
     * @return \Illuminate\Http\Response
     */
    public function edit(Consumer $consumer)
    {
        return view('consumer.create')->withConsumer($consumer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consumer  $Consumer
     * @return \Illuminate\Http\Response
     */
    public function update(ConsumerUpdateRequest $request, Consumer $consumer)
    {
        $data = $request->only('nama_konsumer');

        $consumer->update($data);

        session()->flash('success', 'Consumer telah berhasil di rubah');

        return redirect(route('consumer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consumer  $Consumer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consumer $consumer)
    {

        if ($consumer->orders->count() > 0) {
            session()->flash('error', 'Costumer gagal terhapus karena masih di proses.');

            return back();
        }

        $consumer->delete();

        session()->flash('success', 'Consumer telah berhasil di hapus');

        return redirect(route('consumer.index'));
    }
}
