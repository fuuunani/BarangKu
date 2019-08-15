<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'tb_pengguna';
    protected $fillable = ['usaha', 'nama', 'email', 'password', 'akses'];
    protected $primaryKey = 'kode';
}
