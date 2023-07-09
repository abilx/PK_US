<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function user_rel()
    {
        //hasMany(namamodel, foreign key tabel warga, primary key tabel sendiri)
        return $this->belongsTo(rw::class, 'id', 'user_id' );
    }

    public function petugas_rel()
    {
        //hasMany(namamodel, foreign key tabel warga, primary key tabel sendiri)
        return $this->belongsTo(PK::class, 'id', 'user_id' );
    }

    public function _warga()
    {
        //hasMany(namamodel, foreign key tabel warga, primary key tabel sendiri)
        return $this->belongsTo(Warga::class, 'id', 'user_id');
    }


    public function identitas_rw()
    {
        //hasMany(namamodel, foreign key tabel warga, primary key tabel sendiri)
        return $this->belongsTo(Warga::class, 'id', 'user_id');
    }

    public function keluarga()
    {
        //hasMany(namamodel, foreign key tabel warga, primary key tabel sendiri)
        return $this->belongsTo(Warga::class, 'id', 'user_id');
    }
    public function rt_rel()
    {
        // return $this->hasMany(rt::class);
        return $this->hasMany(rt::class, 'id', 'user_id');
        // return $this->belongsToMany(rt::class, 'id_rw', 'id_rw');
    }
}
