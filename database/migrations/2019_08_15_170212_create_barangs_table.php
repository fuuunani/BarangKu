<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('tb_barang', function (Blueprint $table) {
            $table->char('kode', 10)->primary();
            $table->char('usaha', 10);
            $table->string('nama', 50);
            $table->integer('stok')->default(0);
            $table->integer('harga_jual')->default(0);
            $table->integer('harga_beli')->default(0);
            $table->timestamp('created_at')->default(DB::raw("CURRENT_TIMESTAMP"));
            $table->timestamp('updated_at')->default(DB::raw("CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP"));
            $table->foreign('usaha')->references('kode')->on('tb_usaha');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_barang');
    }
}
