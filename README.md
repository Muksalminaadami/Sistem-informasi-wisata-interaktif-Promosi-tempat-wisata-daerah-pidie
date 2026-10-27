# 🌴 Sistem informasi wisata interaktif Promosi tempat wisata daerah pidie

**Hidden Paradise** adalah platform eksplorasi pariwisata sinematik yang dirancang untuk mempromosikan keindahan alam dan destinasi tersembunyi di Kabupaten Pidie, Aceh. 

Aplikasi ini menggabungkan antarmuka visual modern berorientasi pengalaman pengguna (*user experience*) dengan **Dashboard Administrator** interaktif berbasis **Laravel** untuk pengelolaan data destinasi secara *real-time*.

---

## ✨ Fitur Utama

- **🎬 Cinematic Scroll Experience**: Tampilan beranda interaktif tiga layer dengan efek kedalaman sinematik dan transisi halus.
- **📍 Galeri Destinasi Dinamis**: Menampilkan lokasi wisata pilihan lengkap dengan kategori, wilayah, deskripsi, dan integrasi titik rute **Google Maps**.
- **🔍 Pustaka & Filter Wisata**: Memudahkan pengunjung menjelajahi destinasi berdasarkan kategori favorit (Bahari, Pegunungan, Danau, dll).
- **🌐 Pilihan Bahasa**: Dukungan navigasi multi-bahasa dengan antarmuka *glassmorphism* yang elegan.
- **🛡️ Dashboard Administrator**: Portal khusus pengelola untuk manajemen data destinasi (*Create, Read, Update, Delete*) serta unggah media.

---

## 🛠️ Teknologi yang Digunakan

* **Backend Framework**: Laravel
* **Database**: MySQL / MariaDB
* **Frontend**: Blade Templates, Custom CSS (Glassmorphism & Parallax), JavaScript ES6
* **Icons & Assets**: SVG Line Icons, Custom Web Fonts

---

## 📂 Struktur Utama Proyek

| Ingin mengubah | Lokasi File / Direktori |
|---|---|
| Destinasi wisata (via UI) | Admin Dashboard: `/admin` |
| Tampilan Utama / Beranda | `resources/views/welcome.blade.php` |
| Tampilan Dashboard Admin | `resources/views/admin/*.blade.php` |
| Gaya CSS Utama & Efek | `public/styles.css` |
| Skrip Interaktif & Slider | `public/script.js` |
| Konfigurasi Rute Aplikasi | `routes/web.php` |

---

## 🚀 Langkah Menjalankan di Komputer Lokal

### Kebutuhan Sistem
- PHP 8.2+ & Composer
- MySQL / MariaDB
- Node.js & npm

### Langkah Cepat
1. **Clone Repositori**:
   ```bash
   git clone https://github.com/USERNAME/hidden-paradise.git
   cd hidden-paradise
   ```

2. **Install Dependensi & Konfigurasi**:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

3. **Migrasi Database & Jalankan Server**:
   ```bash
   php artisan migrate --seed
   php artisan serve
   ```
   Akses aplikasi melalui browser di `http://localhost:8000`.

---

<p align="center">
  <i>Dikembangkan dengan ❤️ untuk kemajuan pariwisata Kabupaten Pidie, Aceh.</i>
</p>
