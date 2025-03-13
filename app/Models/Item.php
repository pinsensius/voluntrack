<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'harga_barang',
        'nama_barang',
        'gambar_barang',
        'stok'
    ];
}
