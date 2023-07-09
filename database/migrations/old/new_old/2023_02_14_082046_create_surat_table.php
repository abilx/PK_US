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
        Schema::create('surat', function (Blueprint $table) {
            $table->bigIncrements('id_surat');
            $table->unsignedBigInteger('pengaju')->nullable()->index('surat_pengaju_foreign');
            $table->unsignedBigInteger('rt')->nullable()->index('surat_rt_foreign');
            $table->unsignedBigInteger('rw')->nullable()->index('surat_rw_foreign');
            $table->string('nomor_surat')->nullable()->unique();
            $table->string('jenis_surat');
            $table->smallInteger('status_tandatangan')->comment('0 = RT ; 1 = RT RW; 2 = RW;');
            $table->string('tanda_tangan_rt')->nullable();
            $table->string('tanda_tangan_rw')->nullable();
            $table->string('status_surat', 25)->comment('0 = Baru Diajukan ; 1 = Diterima RT; 2 = Ditolak RT; 3 = Diterima RW; 4 = Selesai ?');
            $table->json('propertie_surat')->nullable();
            $table->text('keperluan_surat')->nullable();
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
        Schema::dropIfExists('surat');
    }
};
