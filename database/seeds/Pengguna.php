<?php

use Illuminate\Database\Seeder;

class Pengguna extends Seeder
{
    public function run()
    {
        factory(App\Pengguna::class, 1)->create();
    }
}
