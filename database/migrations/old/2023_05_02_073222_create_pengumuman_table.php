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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->bigIncrements('id_pengumuman');
            $table->unsignedBigInteger('kategori_pengumuman');
            $table->unsignedBigInteger('id_penanggung_jawab');
            $table->string('penanggung_jawab');
            $table->string('judul_pengumuman');
            $table->text('isi_pengumuman');
            $table->string('foto_pengumuman')->nullable();
            $table->integer('status_pengumuman');
            $table->timestamp('tgl_terbit')->nullable();
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
        Schema::dropIfExists('pengumuman');
    }
};
