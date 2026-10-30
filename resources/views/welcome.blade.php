<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#0b1110" />
    <title>Sistem informasi wisata interaktif - Promosi tempat wisata daerah pidie</title>
    <meta name="description" content="Cerita sinematik tiga layar untuk menjelajahi keindahan wisata di Kabupaten Pidie, Aceh." />
    <link rel="icon" href="data:," />
    <link rel="preconnect" href="https://dcym8fthxf5uu.cloudfront.net" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
    <link rel="stylesheet" href="{{ asset('styles.css') }}" />
    <script src="{{ asset('script.js') }}" defer></script>
  </head>
  <body>
    <!-- Ikon SVG Kustom -->
    <svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
      <defs>
        <symbol id="i-mark" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9.25"/><path d="M6.8 15.2c1.6-3.1 3.2-4.7 5.2-4.7s3.6 1.6 5.2 4.7"/><path d="M8 18.2h8"/></symbol>
        <symbol id="i-globe" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3c2.8 3 2.8 15 0 18"/><path d="M12 3c-2.8 3-2.8 15 0 18"/></symbol>
        <symbol id="i-chev-down" viewBox="0 0 24 24"><path d="m6 9.5 6 6 6-6"/></symbol>
        <symbol id="i-chev-l" viewBox="0 0 24 24"><path d="m14.5 6-6 6 6 6"/></symbol>
        <symbol id="i-chev-r" viewBox="0 0 24 24"><path d="m9.5 6 6 6-6 6"/></symbol>
        <symbol id="i-arrow-ur" viewBox="0 0 24 24"><path d="M7.5 16.5 16.5 7.5"/><path d="M8.5 7.5h8v8"/></symbol>
        <symbol id="i-pin" viewBox="0 0 24 24"><path d="M12 21s-6.5-5.6-6.5-11a6.5 6.5 0 0 1 13 0c0 5.4-6.5 11-6.5 11z"/><circle cx="12" cy="10" r="2.2"/></symbol>
        <symbol id="i-waterfall" viewBox="0 0 24 24"><path d="M12 3.5s6 6 6 10.5a6 6 0 0 1-12 0c0-4.5 6-10.5 6-10.5z"/><path d="M9.4 14.6a2.7 2.7 0 0 0 2.6 2.1"/></symbol>
        <symbol id="i-island" viewBox="0 0 24 24"><path d="M12 16V8.5"/><path d="M12 8.5c-1.6-1.9-3.9-2.1-5.6-1"/><path d="M12 8.5c1.6-1.9 3.9-2.1 5.6-1"/><path d="M3 19.5c2.2 0 2.2-1.4 4.5-1.4s2.3 1.4 4.5 1.4 2.2-1.4 4.5-1.4 2.3 1.4 4.5 1.4"/></symbol>
        <symbol id="i-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3.8"/><path d="M12 3.5v2M12 18.5v2M3.5 12h2M18.5 12h2M6 6l1.4 1.4M16.6 16.6 18 18M18 6l-1.4 1.4M7.4 16.6 6 18"/></symbol>
        <symbol id="i-mountain" viewBox="0 0 24 24"><path d="M3 19.5 9.5 8l4 6.5 2-3 5.5 8z"/></symbol>
        <symbol id="i-compass" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="m15.6 8.4-1.9 5.3-5.3 1.9 1.9-5.3z"/></symbol>
        <symbol id="i-route" viewBox="0 0 24 24"><circle cx="6" cy="18" r="2"/><circle cx="18" cy="6" r="2"/><path d="M8 18h6.2a3 3 0 0 0 0-6H9.8a3 3 0 0 1 0-6H16"/></symbol>
        <symbol id="i-lock" viewBox="0 0 24 24"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></symbol>
        <symbol id="i-close" viewBox="0 0 24 24"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></symbol>
      </defs>
    </svg>

    <main class="site-shell">
      <section class="cinema-scroll" id="cinema" aria-label="Cerita gulir sinematik wisata Kabupaten Pidie">
        <div class="stage">
          <div class="world">
            <img class="scene-img sky-img" src="https://raft-blast-61784561.figma.site/_assets/v11/16b5007d9c93971e26ffe4e0e3e37946f6bd538c.png" alt="" />

            <header class="site-header" aria-label="Navigasi utama">
              <a class="site-logo" href="#cinema" aria-label="Hidden Paradise, ke beranda">
                <svg class="icon logo-mark" aria-hidden="true"><use href="#i-mark" /></svg>
                <span>S.I.W.I</span>
              </a>
              <nav class="site-nav" aria-label="Menu utama">
                <a href="#cinema">Beranda</a>
                <a href="#bridge">Tentang</a>
                <a href="#bazaar">Jelajah</a>
                <a href="#routes">Rute</a>
              </nav>
              <div class="language-menu">
                <button class="language-switcher" type="button" aria-label="Ganti bahasa" aria-haspopup="true" aria-expanded="false" aria-controls="language-list">
                  <svg class="icon" aria-hidden="true"><use href="#i-globe" /></svg>
                  <span>ID</span>
                  <svg class="icon chevron" aria-hidden="true"><use href="#i-chev-down" /></svg>
                </button>
                <ul class="language-list" id="language-list" hidden>
                  <li><button class="language-option is-selected" type="button" aria-current="true"><span class="lang-code">ID</span><span class="lang-name">Bahasa Indonesia</span></button></li>
                  <li><button class="language-option" type="button" disabled><span class="lang-code">EN</span><span class="lang-name">English</span><span class="lang-soon">Segera hadir</span></button></li>
                </ul>
              </div>
            </header>

            <div class="back-stack">
              <img class="scene-img back-img back-four" src="https://raft-blast-61784561.figma.site/_assets/v11/8a7f8af50e0ce92ec2e228e7b0b4112178c51cf1.png" alt="" />

              <!-- SLIDER RUTE WISATA -->
              <section class="sights-slider" aria-label="Rute pilihan wisata Pidie">
                <div class="sights-track">

                  @forelse($destinasi as $item)
                    <article class="sight-card" tabindex="0" role="button" aria-label="{{ $item->nama_destinasi }}" data-destination="{{ $item->nama_destinasi }} Pidie Aceh" data-description="{{ $item->deskripsi }}" data-maps="{{ $item->google_maps ?? '' }}">
                      <div class="sight-media" data-scene="waerebo" style="position: relative; overflow: hidden;">
                        <svg class="scene" viewBox="0 0 400 260" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
                          <circle cx="312" cy="62" r="22" fill="#fff6dc" opacity=".85" />
                          <path d="M0 150C60 105 110 120 170 100S300 90 400 125V260H0z" fill="#8fb9a6" opacity=".7" />
                          <path d="M0 175C70 140 130 160 200 140S330 135 400 160V260H0z" fill="#5f9680" />
                          <path d="M0 205C80 188 150 200 220 192S340 186 400 200V260H0z" fill="#2f6a55" />
                          <ellipse cx="90" cy="196" rx="120" ry="14" fill="#fff" opacity=".55" />
                        </svg>

                        <!-- GAMBAR DESTINASI DARI DATABASE -->
                        @if($item->gambar)
                          <div style="position: absolute; inset: 0; z-index: 999; background: #0b1110;">
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_destinasi }}" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                          </div>
                        @else
                          <div class="sight-photo"></div>
                        @endif

                        <span class="sight-kicker" style="position: relative; z-index: 1000;">
                          <svg class="icon" aria-hidden="true"><use href="#i-island" /></svg>
                          {{ $item->kategori->nama_kategori ?? 'Wisata' }}
                        </span>
                      </div>

                      <div class="sight-body">
                        <h3>{{ $item->nama_destinasi }}</h3>
                        <span class="sight-region">
                          <svg class="icon" aria-hidden="true"><use href="#i-pin" /></svg>
                          {{ $item->wilayah->nama_wilayah ?? 'Pidie, Aceh' }}
                        </span>
                        <p class="sight-desc">{{ $item->deskripsi }}</p>
                        <div class="sight-foot-actions">
                          <span class="sight-foot desc-toggle-action">
                            <svg class="icon" aria-hidden="true"><use href="#i-compass" /></svg>Lihat Deskripsi
                          </span>
                          <span class="sight-foot map-action">
                            <svg class="icon" aria-hidden="true"><use href="#i-route" /></svg>Maps
                          </span>
                        </div>
                      </div>
                    </article>
                  @empty
                    <div style="padding: 40px; text-align: center; color: #fdf1e1; background: rgba(20,32,30,0.8); border-radius: 16px; width: 300px;">
                      <p>Belum ada data rute destinasi di database. Silakan tambah melalui Dashboard Admin.</p>
                    </div>
                  @endforelse

                </div>
              </section>

              <img class="scene-img back-img back-bazaar" src="https://raft-blast-61784561.figma.site/_assets/v11/864afe00e41e2fa20a5aa546e15cb807e0f81384.png" alt="" />
            </div>

            <div class="sights-controls" aria-label="Kontrol rute">
              <button class="sight-nav sight-prev" type="button" aria-label="Tempat sebelumnya"><svg class="icon" aria-hidden="true"><use href="#i-chev-l" /></svg></button>
              <button class="sight-nav sight-next" type="button" aria-label="Tempat berikutnya"><svg class="icon" aria-hidden="true"><use href="#i-chev-r" /></svg></button>
            </div>

            <h1 class="hero-title">Wisata Pidie</h1>

            <img class="scene-img splitframe-img splitframe-left" src="https://raft-blast-61784561.figma.site/_assets/v11/7536d7b60a1fce482cf6edf3f0bffd3bad5d0f8a.png" alt="" />
            <img class="scene-img splitframe-img splitframe-right" src="https://raft-blast-61784561.figma.site/_assets/v11/392db6a6a6b98e868bd7f8d3f55bb719d51e5028.png" alt="" />
            <img class="scene-img bridge-img" src="https://raft-blast-61784561.figma.site/_assets/v11/c6a6d8ef49bca43f708aa852692942c45ec950d4.png" alt="" />
            <img class="scene-img frame-two-img" src="https://raft-blast-61784561.figma.site/_assets/v11/ba75252bab2b1c510987b74837770f7bc8a6b2d4.png" alt="" />

            <div class="shade"></div>
          </div>

          <section class="intro-copy" aria-label="Gambaran umum">
            <p>Pantai senja, air terjun pegunungan yang sejuk, hingga jejak pesona lokal: Kabupaten Pidie menyimpan banyak keindahan tersembunyi yang siap untuk dijelajahi.</p>
            <div class="hero-tags" aria-label="Sorotan wisata Pidie">
              <button type="button" data-sight="0" aria-label="Jelajahi Rute Pidie"><svg class="icon" aria-hidden="true"><use href="#i-island" /></svg>Jelajahi Rute</button>
            </div>
          </section>

          <section class="story-panel story-panel-bridge" aria-label="Tentang website ini">
            <h2>Dibuat untuk para penjelajah.</h2>
            <p>Sistem informasi wisata interaktif Promosi tempat wisata daerah pidie membantu kamu menemukan destinasi terbaik di Kabupaten Pidie, dengan rute jelas dan informasi lengkap agar perjalananmu semakin menyenangkan.</p>
            <dl class="facts">
              <div>
                <dt><svg class="icon" aria-hidden="true"><use href="#i-compass" /></svg></dt>
                <dd>Temukan tempat eksotis di Pidie</dd>
              </div>
              <div>
                <dt><svg class="icon" aria-hidden="true"><use href="#i-route" /></svg></dt>
                <dd>Atur rute perjalanan dengan mudah</dd>
              </div>
            </dl>
          </section>

          <section class="story-panel story-panel-bazaar" aria-label="Jelajahi tempat tersembunyi" inert>
            <h2>Pesona Pidie di setiap sudutnya.</h2>
            <p>Dari deburan ombak hingga sejuknya alam pegunungan: temukan keindahan alam Kabupaten Pidie yang menawan.</p>
            <button class="note-button" type="button" data-target="#routes">
              <span>Lihat rute pilihan</span>
              <svg class="icon" aria-hidden="true"><use href="#i-arrow-ur" /></svg>
            </button>
          </section>
        </div>
      </section>
    </main>

    <!-- MODAL LOGIN ADMIN -->
    <div class="admin-modal-overlay {{ session('showAdminModal') ? 'is-open' : '' }}" id="adminModalOverlay" aria-hidden="true">
      <div class="admin-modal-box">
        <button class="admin-modal-close" id="adminModalClose" type="button" aria-label="Tutup login admin">
          <svg class="icon"><use href="#i-close" /></svg>
        </button>
        <div class="admin-modal-header">
          <div class="admin-icon-circle">
            <svg class="icon"><use href="#i-lock" /></svg>
          </div>
          <h3>Portal Administrator</h3>
          <p>Sistem Informasi Wisata Pidie</p>
        </div>
        
        <form class="admin-login-form" action="{{ route('admin.login') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="adminUsername">Username</label>
            <input type="text" name="username" id="adminUsername" placeholder="Masukkan username admin" required autocomplete="username" />
          </div>
          <div class="form-group">
            <label for="adminPassword">Password</label>
            <input type="password" name="password" id="adminPassword" placeholder="Masukkan password" required autocomplete="current-password" />
          </div>

          @if(session('error'))
            <div class="form-error" style="color: #ff6b6b; margin-bottom: 14px; text-align: center; font-size: 0.85rem;">{{ session('error') }}</div>
          @endif

          <button type="submit" class="admin-btn-login">Masuk ke Dashboard</button>
        </form>
      </div>
    </div>

    <!-- SCRIPT UNTUK MEMBUKA LINK GOOGLE MAPS KUSTOM DARI ADMIN -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.map-action').forEach(function(mapBtn) {
          mapBtn.addEventListener('click', function(e) {
            const card = this.closest('.sight-card');
            if (card) {
              const customMapsUrl = card.getAttribute('data-maps');
              if (customMapsUrl && customMapsUrl.trim() !== '' && customMapsUrl !== 'null') {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                window.open(customMapsUrl, '_blank');
              }
            }
          }, true);
        });
      });
    </script>
  </body>
</html>