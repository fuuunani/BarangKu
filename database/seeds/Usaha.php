<?php

use Illuminate\Database\Seeder;

class Usaha extends Seeder
{
    public function run()
    {
        factory(App\Usaha::class, 20)->create();
    }
}
