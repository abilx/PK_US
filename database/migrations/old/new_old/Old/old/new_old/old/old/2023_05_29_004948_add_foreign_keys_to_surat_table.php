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
        Schema::table('surat', function (Blueprint $table) {
            $table->foreign(['pengaju'])->references(['id_warga'])->on('wargas');
            $table->foreign(['rw'])->references(['id_rw'])->on('rws');
            $table->foreign(['rt'])->references(['id_rt'])->on('rts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropForeign('surat_pengaju_foreign');
            $table->dropForeign('surat_rw_foreign');
            $table->dropForeign('surat_rt_foreign');
        });
    }
};
