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
        Schema::table('petugas_kelurahan', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_userid_petugas')->references(['id'])->on('users')->onUpdate('CASCADE');
            $table->foreign(['id_warga'], 'fk_id_warga')->references(['id_warga'])->on('wargas')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('petugas_kelurahan', function (Blueprint $table) {
            $table->dropForeign('fk_userid_petugas');
            $table->dropForeign('fk_id_warga');
        });
    }
};
