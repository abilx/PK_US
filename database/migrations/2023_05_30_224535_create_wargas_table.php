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
        Schema::create('wargas', function (Blueprint $table) {
            $table->bigIncrements('id_warga');
            $table->integer('user_id')->nullable()->index('fk_userid_warga');
            $table->string('nik');
            $table->string('nama_lengkap');
            $table->string('no_kk');
            $table->string('nama_kepala_keluarga');
            $table->string('nokk_kepala_keluarga');
            $table->integer('status_hubungan_dalam_keluarga');
            $table->text('alamat');
            $table->unsignedBigInteger('kelurahan');
            $table->unsignedBigInteger('kecamatan');
            $table->unsignedBigInteger('kabupaten');
            $table->unsignedBigInteger('provinsi');
            $table->string('nama_dusun');
            $table->string('kode_pos');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir')->nullable();
            $table->integer('jenis_kelamin')->comment('1 => Laki-laki 2 => Perempuan');
            $table->unsignedBigInteger('agama');
            $table->unsignedBigInteger('golongan_darah');
            $table->unsignedBigInteger('pendidikan');
            $table->unsignedBigInteger('pekerjaan');
            $table->enum('status_perkawinan', ['belum_kawin', 'kawin', 'cerai_hidup', 'cerai']);
            $table->integer('jenis_warga')->comment('1 => Tetap 0 => Tidak tetap');
            $table->string('nomor_passport')->nullable();
            $table->date('tgl_akhir_passport')->nullable();
            $table->string('nomor_kitaskitap')->nullable()->unique();
            $table->string('nik_ayah');
            $table->string('nama_ayah');
            $table->string('nik_ibu');
            $table->string('nama_ibu');
            $table->date('tgl_keluar_kk')->nullable();
            $table->string('foto_warga')->default('no-image.png');
            $table->date('tgl_perkawinan')->nullable();
            $table->string('akta_kawin')->nullable();
            $table->string('akta_cerai')->nullable();
            $table->date('tgl_cerai')->nullable();
            $table->string('akta_kelahiran')->nullable();
            $table->string('kelainan')->nullable();
            $table->string('email_warga')->nullable();
            $table->string('no_hp_warga')->nullable();
            $table->unsignedBigInteger('rt')->nullable();
            $table->unsignedBigInteger('rw')->nullable();
            $table->integer('penerima_beasiswa')->nullable()->default(0)->comment('0 = Tidak Menerima;
1 = Menerima');
            $table->integer('status_warga')->nullable()->comment('0=>Hidup; 1=>Mati; 3=>Pindah');
            $table->integer('active')->default(1)->comment('1=>Aktif; 0=>Non Aktif');
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
        Schema::dropIfExists('wargas');
    }
};
