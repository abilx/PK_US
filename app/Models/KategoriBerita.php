<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;
    protected $table = "kategori_beritas";
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }

}
