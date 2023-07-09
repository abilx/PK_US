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
        Schema::create('rws', function (Blueprint $table) {
            $table->bigIncrements('id_rw');
            $table->integer('user_id');
            $table->string('username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('no_rw');
            $table->unsignedBigInteger('id_warga');
            $table->string('ketua_rw');
            $table->timestamp('tgl_awal_jabatan_rw')->nullable();
            $table->timestamp('tgl_akhir_jabatan_rw')->nullable();
            $table->integer('status_rw');
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
        Schema::dropIfExists('rws');
    }
};
