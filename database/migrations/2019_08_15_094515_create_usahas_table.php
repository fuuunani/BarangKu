<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsahasTable extends Migration
{    
    public function up()
    {
        Schema::create('tb_usaha', function (Blueprint $table) {
            $table->char('kode', 10)->primary();
            $table->string('nama', 50);
            $table->text('alamat', 50)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->char('telp', 12)->nullable();
            $table->timestamp('created_at')->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->timestamp('updated_at')->default(DB::raw("CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP"));
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_usaha');
    }
}
