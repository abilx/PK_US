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
        Schema::create('petugas_kelurahan', function (Blueprint $table) {
            $table->bigIncrements('id_rw');
            $table->integer('user_id');
            $table->string('username')->nullable()->unique('rws_username_unique');
            $table->string('password')->nullable();
            $table->string('no_rw');
            $table->unsignedBigInteger('id_warga');
            $table->timestamp('tgl_awal_jabatan_petugas_kelurahan')->nullable();
            $table->timestamp('tgl_akhir_jabatan_petugas_kelurahan')->nullable();
            $table->integer('status_petugas_kelurahan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petugas_kelurahan');
    }
};
