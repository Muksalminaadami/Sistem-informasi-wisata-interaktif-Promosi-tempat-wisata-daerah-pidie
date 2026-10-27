<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model {
    protected $table = 'kategori';
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function destinasi() {
        return $this->hasMany(Destinasi::class, 'kategori_id');
    }
}