<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tb_barang';
    protected $fillable = ['kode', 'usaha', 'nama', 'stok', 'harga_jual', 'harga_beli'];
    protected $primaryKey = 'kode';
    public $incrementing = false;
}
