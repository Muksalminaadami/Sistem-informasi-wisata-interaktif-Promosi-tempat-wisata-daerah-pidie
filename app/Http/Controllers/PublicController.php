<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Kategori;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class PublicController extends Controller {
    public function index(Request $request) {
        // Mengambil seluruh data destinasi beserta relasi kategori & wilayah dari database
        $destinasi = Destinasi::with(['kategori', 'wilayah'])->get();
        $kategori = Kategori::all();
        $wilayah = Wilayah::all();

        return view('welcome', compact('destinasi', 'kategori', 'wilayah'));
    }
}