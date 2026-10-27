<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model {
    protected $table = 'wilayah';
    protected $fillable = ['nama_wilayah', 'deskripsi'];

    public function destinasi() {
        return $this->hasMany(Destinasi::class, 'wilayah_id');
    }
}