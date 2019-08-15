<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(Usaha::class);
        $this->call(Pengguna::class);
        $this->call(Barang::class);
    }
}
