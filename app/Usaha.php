<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    protected $table = 'tb_usaha';
    protected $fillable = ['kode', 'nama', 'alamat', 'email', 'telp'];
    protected $primaryKey = 'kode';
    public $incrementing = false;
}
