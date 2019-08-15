<?php

use Illuminate\Database\Seeder;

class Barang extends Seeder
{
    public function run()
    {
        factory(App\Barang::class, 500)->create();
    }
}
