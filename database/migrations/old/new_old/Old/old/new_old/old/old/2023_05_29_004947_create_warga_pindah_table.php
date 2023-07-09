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
        Schema::create('warga_pindah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('warga')->index('warga_pindah_warga_foreign');
            $table->string('dokumen_pindah');
            $table->date('tanggal_pindah');
            $table->text('alamat_pindah');
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
        Schema::dropIfExists('warga_pindah');
    }
};
