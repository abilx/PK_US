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
        Schema::table('fasilitas_umums', function (Blueprint $table) {
            $table->foreign(['rt'])->references(['id_rt'])->on('rts')->onUpdate('CASCADE');
            $table->foreign(['kategori_fasilitas_umum'])->references(['id_kategori_fasilitas'])->on('kategori_fasilitas_umums');
            $table->foreign(['rw'])->references(['id_rw'])->on('rws')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fasilitas_umums', function (Blueprint $table) {
            $table->dropForeign('fasilitas_umums_rt_foreign');
            $table->dropForeign('fasilitas_umums_kategori_fasilitas_umum_foreign');
            $table->dropForeign('fasilitas_umums_rw_foreign');
        });
    }
};
