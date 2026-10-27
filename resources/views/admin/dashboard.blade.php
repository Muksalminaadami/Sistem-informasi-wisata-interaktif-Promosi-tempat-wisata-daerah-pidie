<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Wisata Pidie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
</head>
<body class="admin-body">
    <div class="container-fluid">
        <header class="admin-topbar">
            <div class="admin-brand">
                <span class="admin-brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9.25"/><path d="M6.8 15.2c1.6-3.1 3.2-4.7 5.2-4.7s3.6 1.6 5.2 4.7"/><path d="M8 18.2h8"/></svg>
                </span>
                <div>
                    <h1>Hidden Paradise</h1>
                    <p>Dashboard Panel Admin Wisata Pidie</p>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </header>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card p-3 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="section-title">Daftar Destinasi Wisata <span class="count-badge">{{ $destinasi->count() }}</span></h2>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    + Tambah Destinasi
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Destinasi</th>
                            <th>Kategori</th>
                            <th>Wilayah</th>
                            <th>Google Maps</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinasi as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_destinasi }}" class="dest-thumb">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $item->nama_destinasi }}</td>
                                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $item->wilayah->nama_wilayah ?? '-' }}</td>
                                <td>
                                    @if($item->google_maps)
                                        <a href="{{ $item->google_maps }}" target="_blank" class="btn btn-sm btn-outline-info">Buka Maps</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="aksi-group">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">Edit</button>
                                        <form action="{{ route('admin.destinasi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">Belum ada data destinasi. Klik "+ Tambah Destinasi" di atas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SEMUA MODAL EDIT DILETAKKAN DI LUAR TABEL AGAR FILE UPLOAD TIDAK RUSAK -->
    @foreach($destinasi as $item)
    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Destinasi: {{ $item->nama_destinasi }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.destinasi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Destinasi</label>
                            <input type="text" name="nama_destinasi" class="form-control" value="{{ $item->nama_destinasi }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}" {{ $item->kategori_id == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Wilayah</label>
                            <select name="wilayah_id" class="form-select" required>
                                @foreach($wilayah as $wil)
                                    <option value="{{ $wil->id }}" {{ $item->wilayah_id == $wil->id ? 'selected' : '' }}>
                                        {{ $wil->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required>{{ $item->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Google Maps (URL)</label>
                            <input type="text" name="google_maps" class="form-control" value="{{ $item->google_maps }}" placeholder="https://maps.app.goo.gl/...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ganti Gambar (Opsional)</label>
                            <input type="file" name="gambar" class="form-control">
                            @if($item->gambar)
                                <small class="text-muted d-block mt-1">File saat ini: {{ basename($item->gambar) }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <!-- MODAL TAMBAH DESTINASI -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Destinasi Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.destinasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Destinasi</label>
                            <input type="text" name="nama_destinasi" class="form-control" placeholder="Masukkan nama destinasi" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Wilayah</label>
                            <select name="wilayah_id" class="form-select" required>
                                <option value="">-- Pilih Wilayah --</option>
                                @foreach($wilayah as $wil)
                                    <option value="{{ $wil->id }}">{{ $wil->nama_wilayah }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi lengkap destinasi" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Google Maps (URL)</label>
                            <input type="text" name="google_maps" class="form-control" placeholder="Contoh: https://maps.app.goo.gl/...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Gambar (Opsional)</label>
                            <input type="file" name="gambar" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah Destinasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>