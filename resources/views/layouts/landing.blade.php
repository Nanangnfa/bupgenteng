<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>BUP Genteng</title>
  <meta name="description" content="Balai Usaha Perikanan Genteng">
  <meta name="keywords" content="bibit ikan, perikanan, BUP Genteng">

  <link href="{{ asset('template-landing/assets/img/ikan.png') }}" rel="icon">
  <link href="{{ asset('template-landing/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Marcellus:wght@400&display=swap" rel="stylesheet">

  <link href="{{ asset('template-landing/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template-landing/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('template-landing/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('template-landing/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template-landing/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <link href="{{ asset('template-landing/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="@yield('body-class', 'index-page')">

  <header id="header" class="p-2 header d-flex align-items-center position-relative">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{ route('landing.index') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('template-landing/assets/img/logo.png') }}" alt="BUP Genteng">
      </a>

      <nav id="navmenu" class="navmenu fw-bold">
        <ul>
          <li>
            <a href="{{ route('landing.index') }}"
              class="{{ request()->routeIs('landing.index') ? 'active' : '' }}">
              Dashboard
            </a>
          </li>

          <li>
            <a href="{{ route('landing.profil') }}"
              class="{{ request()->routeIs('landing.profil') ? 'active' : '' }}">
              Profil
            </a>
          </li>

          <li>
            <a href="{{ route('landing.visi-misi') }}"
              class="{{ request()->routeIs('landing.visi-misi') ? 'active' : '' }}">
              Visi Misi
            </a>
          </li>

          <li>
            <a href="{{ route('landing.pemesanan') }}"
              class="{{ request()->routeIs('landing.pemesanan') ? 'active' : '' }}">
              Pemesanan
            </a>
          </li>
        </ul>

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">
    @yield('content')
  </main>

  <!-- Call To Action Section -->
  <section id="call-to-action" class="call-to-action section light-background">

    <div class="content">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h3>Butuh Informasi Bibit Ikan?</h3>
            <p class="opacity-50">
              Hubungi admin BUP Genteng untuk mendapatkan informasi lebih lanjut mengenai ketersediaan bibit ikan, pemesanan, dan layanan perikanan.
            </p>
          </div>
          <div class="col-lg-6">
            <div class="col-lg-6 text-lg-end text-start">
              <a href="https://wa.me/6285935044462?text=Halo%20Admin%20BUP%20Genteng%2C%20saya%20ingin%20bertanya%20tentang%20bibit%20ikan."
                target="_blank"
                class="btn-wa-custom"
                style="user-select: none;">
                <i class="bi bi-whatsapp disabled"></i>
                Hubungi Kami
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- /Call To Action Section -->

  <footer id="footer" class="footer dark-background">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">

          <div class="col-lg-4 col-md-6 footer-about">
            <a href="{{ route('landing.index') }}" class="logo d-flex align-items-center">
              <span class="sitename">BUP Genteng</span>
            </a>

            <div class="footer-contact pt-3">
              <p>{{ $profil->alamat ?? 'Alamat belum diisi' }}</p>
              <p class="mt-3">
                <strong>Telepon:</strong>
                <span>{{ $profil->telepon ?? '-' }}</span>
              </p>
              <p>
                <strong>Email:</strong>
                <span>{{ $profil->email ?? '-' }}</span>
              </p>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Menu</h4>
            <ul>
              <li><a href="{{ route('landing.index') }}">Dashboard</a></li>
              <li><a href="{{ route('landing.profil') }}">Profil</a></li>
              <li><a href="{{ route('landing.visi-misi') }}">Visi Misi</a></li>
              <li><a href="{{ route('landing.pemesanan') }}">Pemesanan</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-3 footer-links">
            <h4>Layanan</h4>
            <ul>
              <li><a href="#">Informasi Bibit Ikan</a></li>
              <li><a href="#">Pemesanan Bibit</a></li>
              <li><a href="#">Konsultasi Perikanan</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="copyright text-center">
      <div class="container">
        <div>
          © Copyright <strong><span>BUP Genteng</span></strong>. All Rights Reserved
        </div>
      </div>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <div id="preloader"></div>

  <script src="{{ asset('template-landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template-landing/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('template-landing/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('template-landing/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('template-landing/assets/js/main.js') }}"></script>

</body>

</html>