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
        Schema::table('wargas', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_userid_warga')->references(['id'])->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wargas', function (Blueprint $table) {
            $table->dropForeign('fk_userid_warga');
        });
    }
};
