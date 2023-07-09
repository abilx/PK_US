<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PK extends Authenticatable 
{
    use HasFactory;

    protected $table = 'petugas_kelurahan';
    protected $primaryKey = 'id_pk';
    protected $guarded = ['id_pk'];
    protected $dates = ['tgl_awal_jabatan_petugas_kelurahan', 'tgl_akhir_jabatan_petugas_kelurahan'];
    // protected $with =['identitas_rw'];

    public function getRouteKeyName()
    {
        return 'id_pk';
    }

    public function _warga()
    {
        //hasMany(namamodel, foreign key tabel warga, primary key tabel sendiri)
        return $this->hasMany(Warga::class, 'pk', 'id_pk');
    }

    public function identitas_pk()
    {
        //hasMany(namamodel, foreign key tabel warga, primary key tabel sendiri)
        return $this->belongsTo(Warga::class, 'id_warga', 'id_warga');
    }

    public function keluarga()
    {
        //hasMany(namamodel, foreign key tabel warga, primary key tabel sendiri)
        return $this->belongsTo(Warga::class, 'no_kk', 'no_kk');
    }
    public function rt_rel()
    {
        // return $this->hasMany(rt::class);
        return $this->hasMany(rt::class, 'id_rw', 'id_rw');
        // return $this->belongsToMany(rt::class, 'id_rw', 'id_rw');
    }
}
