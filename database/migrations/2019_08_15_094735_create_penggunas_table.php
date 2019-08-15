<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenggunasTable extends Migration
{
    public function up()
    {
        Schema::create('tb_pengguna', function (Blueprint $table) {
            $table->increments('kode', 10);
            $table->char('usaha', 10);
            $table->string('nama', 50);
            $table->string('email', 100)->unique();
            $table->string('password', 50);
            $table->enum('akses', [0, 1, 2])->default(0);
            $table->timestamp('created_at')->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->timestamp('updated_at')->default(DB::raw("CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP"));
            $table->foreign('usaha')->references('kode')->on('tb_usaha');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_pengguna');
    }
}
