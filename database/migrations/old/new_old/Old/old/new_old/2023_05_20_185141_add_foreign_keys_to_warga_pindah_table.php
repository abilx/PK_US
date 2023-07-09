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
        Schema::table('warga_pindah', function (Blueprint $table) {
            $table->foreign(['warga'])->references(['id_warga'])->on('wargas')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warga_pindah', function (Blueprint $table) {
            $table->dropForeign('warga_pindah_warga_foreign');
        });
    }
};
