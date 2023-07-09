<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas_umums', function (Blueprint $table) {
            $table->bigIncrements('id_fasilitas_umum');
            $table->unsignedBigInteger('kategori_fasilitas_umum')->index('fasilitas_umums_kategori_fasilitas_umum_foreign');
            $table->unsignedBigInteger('rt')->index('fasilitas_umums_rt_foreign')->nullable();
            $table->unsignedBigInteger('rw')->index('fasilitas_umums_rw_foreign');
            $table->string('fasilitas_umum');
            $table->text('deskripsi_fasilitas');
            $table->text('koordinant_fasilitas')->nullable();
            $table->string('foto_fasilitas');
            $table->integer('status_fasilitas');
            $table->string('alamat_fasilitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fasilitas_umums');
    }
};
