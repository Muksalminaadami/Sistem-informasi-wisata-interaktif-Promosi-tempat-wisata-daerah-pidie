<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Destinasi;
use App\Models\Kategori;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class AdminController extends Controller {

    public function showLoginForm() {
        return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $input = trim($request->input('username') ?? $request->input('name') ?? $request->input('email'));

        $admin = Admin::where('name', 'LIKE', $input)
                    ->orWhere('email', 'LIKE', $input)
                    ->first();

        if (!$admin) {
            $admin = Admin::create([
                'name' => $input,
                'email' => $input . '@wisatapidie.com',
                'password' => Hash::make($request->password),
            ]);
        } else {
            $admin->password = Hash::make($request->password);
            $admin->save();
        }

        Auth::login($admin);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('success', 'Login Berhasil!');
    }

    public function dashboard() {
        $destinasi = Destinasi::with(['kategori', 'wilayah'])->get();
        $kategori = Kategori::all();
        $wilayah = Wilayah::all();

        return view('admin.dashboard', compact('destinasi', 'kategori', 'wilayah'));
    }

    public function storeDestinasi(Request $request) {
        $request->validate([
            'nama_destinasi' => 'required',
            'kategori_id' => 'required',
            'wilayah_id' => 'required',
            'deskripsi' => 'required',
            'google_maps' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destinationPath = public_path('uploads/destinasi');
            
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            
            $file->move($destinationPath, $filename);
            $data['gambar'] = 'uploads/destinasi/' . $filename;
        } else {
            $data['gambar'] = null;
        }

        Destinasi::create($data);

        return redirect()->back()->with('success', 'Status: Berhasil menambah destinasi baru ke database!');
    }

    public function updateDestinasi(Request $request, $id) {
        $request->validate([
            'nama_destinasi' => 'required',
            'kategori_id' => 'required',
            'wilayah_id' => 'required',
            'deskripsi' => 'required',
            'google_maps' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $destinasi = Destinasi::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($destinasi->gambar && File::exists(public_path($destinasi->gambar))) {
                File::delete(public_path($destinasi->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destinationPath = public_path('uploads/destinasi');
            
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            
            $file->move($destinationPath, $filename);
            $data['gambar'] = 'uploads/destinasi/' . $filename;
        } else {
            unset($data['gambar']);
        }

        $destinasi->update($data);

        return redirect()->back()->with('success', 'Status: Berhasil memperbarui data destinasi!');
    }

    public function destroyDestinasi($id) {
        $destinasi = Destinasi::findOrFail($id);
        
        if ($destinasi->gambar && File::exists(public_path($destinasi->gambar))) {
            File::delete(public_path($destinasi->gambar));
        }

        $destinasi->delete();
        return redirect()->back()->with('success', 'Status: Berhasil menghapus data dari database!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Berhasil logout!');
    }
}