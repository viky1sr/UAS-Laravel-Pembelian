<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status_order', 'total_harga', 'consumer_id', 'qty', 'produk_id'];


    public function consumers()
    {
        return $this->belongsTo(Consumer::class, 'consumer_id');
    }

    public function produks()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
