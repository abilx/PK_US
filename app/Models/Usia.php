<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usia extends Model
{
    protected $table = 'wargas';
    protected $fillable = ['user_id', 'nik','tgl_lahir'];

    public function tampilSemua()
    {
        return $this->all();
    }

}
