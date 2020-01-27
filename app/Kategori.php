<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['name'];


    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    // public function produks()
    // {
    //     $this->hasMany(Produk::class);
    // }
}
