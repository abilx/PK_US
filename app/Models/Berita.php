<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    
    protected $table = "beritas";
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    // protected $fillable = [

    public function beritas()
    {
        return $this->belongsTo(KategoriKegiatan::class, 'kategori_berita', 'id_kategori_kegiatan');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query
                ->where('judul', 'like', '%' . $search . '%')
                ->orWhere('isi', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('beritas', function ($query) use ($category) {
                $query->where('id_kategori_kegiatan', $category);
            });
        });
    }
}
