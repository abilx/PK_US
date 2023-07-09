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
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreign(['id_warga'])->references(['id_warga'])->on('wargas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['id_iuran'])->references(['id_iuran'])->on('iurans')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign('pembayaran_id_warga_foreign');
            $table->dropForeign('pembayaran_id_iuran_foreign');
        });
    }
};
