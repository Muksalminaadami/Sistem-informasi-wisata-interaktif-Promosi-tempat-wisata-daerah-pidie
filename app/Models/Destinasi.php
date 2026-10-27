<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi';

    // Izinkan semua kolom ini diisi melalui form admin
    protected $fillable = [
        'nama_destinasi',
        'kategori_id',
        'wilayah_id',
        'deskripsi',
        'gambar',
        'google_maps',
        'lokasi_map',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }
}