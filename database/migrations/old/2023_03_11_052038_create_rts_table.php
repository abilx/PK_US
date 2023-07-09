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
        Schema::create('rts', function (Blueprint $table) {
            $table->bigIncrements('id_rt');
            $table->integer('user_id')->index('fk_userid_rt');
            $table->unsignedBigInteger('id_rw');
            $table->string('username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('no_rt');
            $table->unsignedBigInteger('id_warga');
            $table->string('ketua_rt');
            $table->timestamp('tgl_awal_jabatan_rt')->nullable();
            $table->timestamp('tgl_akhir_jabatan_rt')->nullable();
            $table->integer('status_rt');
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
        Schema::dropIfExists('rts');
    }
};
