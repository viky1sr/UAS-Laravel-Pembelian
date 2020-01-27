<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    protected $fillable = ['nama_konsumer', 'alamat'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
