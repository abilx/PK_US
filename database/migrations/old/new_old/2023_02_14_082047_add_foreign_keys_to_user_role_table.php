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
        Schema::table('user_role', function (Blueprint $table) {
            $table->foreign(['role_id'], 'fk_role_id')->references(['role_id'])->on('role')->onUpdate('CASCADE');
            $table->foreign(['username'], 'fk_username')->references(['username'])->on('user')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_role', function (Blueprint $table) {
            $table->dropForeign('fk_role_id');
            $table->dropForeign('fk_username');
        });
    }
};
