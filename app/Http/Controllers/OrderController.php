<?php

namespace App\Http\Controllers;

use App\Consumer;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\Produk;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index')->with('orders', Order::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create')->with('consumers', Consumer::all())->with('produks', Produk::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $produk = Produk::find($request->produk);
        Order::create([
            'qty' => $request->qty,
            'consumer_id' => $request->consumer,
            'produk_id' => $request->produk,
            'total_harga' => $request->qty * $produk->harga
        ]);

        session()->flash('success', 'Order berhasil tersimpan.');

        return redirect(route('order.index'));
    }

    /**asd
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $status_orderToInt = (int)$request->status_order;

        $order->status_order = $status_orderToInt;

        $order->save();

        session()->flash('success', 'Order berhasil dirubah.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
