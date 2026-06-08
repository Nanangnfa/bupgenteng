@extends('layouts.landing')

@section('body-class', 'index-page')

@section('content')

<section id="hero" class="hero section dark-background">

  <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000" 
        style="width: 100%; height: 100vh; object-fit: cover; object-position: center;">

    <div class=" carousel-item active">
    <img src="{{ asset('template-landing/assets/img/hero_1.jpg') }}">

    <div class="carousel-container">
      <h2>Selamat Datang di, Balai Usaha Perikanan Genteng</h2>
      <p>Pusat informasi dan pelayanan bibit ikan yang membantu masyarakat memperoleh data ketersediaan bibit secara mudah, cepat, dan terarah.</p>
    </div>
  </div>

  <div class="carousel-item">
    <img src="{{ asset('template-landing/assets/img/hero_2.jpg') }}"
      alt="Hero Image">

    <div class="carousel-container">
      <h2>Akses Informasi Bibit Ikan Lebih Mudah</h2>
      <p>Lihat stok bibit ikan yang tersedia, pilih jenis bibit sesuai kebutuhan, lalu lakukan pemesanan melalui form online yang telah disediakan.</p>
    </div>
  </div>

  <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
  </a>

  <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
  </a>

  <ol class="carousel-indicators"></ol>

  </div>

</section>

<!-- Services Section -->
<section id="services" class="services section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>SERVICES</h2>
    <p>Providing Fresh Produce Every Single Day</p>
  </div><!-- End Section Title -->
  <div class="content">
    <div class="container">
      <div class="row g-0">

        <div class="col-lg-3 col-md-6">
          <div class="service-item">
            <span class="number">01</span>
            <div class="service-item-icon">
              <svg class="fishery-icon" viewBox="0 0 100 100">
                <path d="M12 50C26 30 55 30 72 50C55 70 26 70 12 50Z" />
                <path d="M72 50L90 36V64L72 50Z" />
                <circle cx="31" cy="46" r="3" />
                <path d="M43 39C51 45 51 55 43 61" />
                <path d="M18 73C32 66 49 66 64 73" />
              </svg>
            </div>
            <div class="service-item-content">
              <h3 class="service-heading">Bibit Ikan</h3>
              <p>
                Menyediakan informasi bibit ikan yang tersedia untuk kebutuhan masyarakat.
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="service-item">
            <span class="number">02</span>
            <div class="service-item-icon">
              <svg class="fishery-icon" viewBox="0 0 100 100">
                <path d="M17 58C24 44 38 36 52 36C66 36 78 44 84 58" />
                <path d="M16 58C28 70 72 70 84 58" />
                <path d="M28 58C34 52 43 49 52 49C61 49 69 52 75 58" />
                <path d="M23 75H77" />
                <path d="M30 75V64" />
                <path d="M70 75V64" />
                <circle cx="52" cy="43" r="4" />
              </svg>
            </div>
            <div class="service-item-content">
              <h3 class="service-heading">Kolam Budidaya</h3>
              <p>
                Mendukung pengelolaan budidaya ikan melalui data yang lebih tertata.
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="service-item">
            <span class="number">05</span>
            <div class="service-item-icon">
              <svg class="fishery-icon" viewBox="0 0 100 100">
                <path d="M20 63C32 48 52 48 64 63C52 78 32 78 20 63Z" />
                <path d="M64 63L78 52V74L64 63Z" />
                <circle cx="33" cy="60" r="2.5" />
                <path d="M24 35C31 27 43 27 50 35C43 43 31 43 24 35Z" />
                <path d="M50 35L61 27V43L50 35Z" />
                <circle cx="34" cy="33" r="2" />
                <path d="M19 84C35 76 62 76 81 84" />
              </svg>
            </div>
            <div class="service-item-content">
              <h3 class="service-heading">Benih Unggul</h3>
              <p>
                Bibit dipilih untuk mendukung hasil budidaya ikan yang lebih optimal.
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="service-item">
            <span class="number">08</span>
            <div class="service-item-icon">
              <svg class="fishery-icon" viewBox="0 0 100 100">
                <path d="M23 30H77V75H23V30Z" />
                <path d="M32 30C32 22 38 16 46 16H54C62 16 68 22 68 30" />
                <path d="M33 51C41 41 58 41 67 51C58 61 41 61 33 51Z" />
                <path d="M67 51L78 43V59L67 51Z" />
                <circle cx="43" cy="49" r="2" />
                <path d="M34 75V84" />
                <path d="M66 75V84" />
              </svg>
            </div>
            <div class="service-item-content">
              <h3 class="service-heading">Pemesanan Bibit</h3>
              <p>
                Masyarakat dapat melakukan pemesanan bibit ikan melalui form online.
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section><!-- /Services Section -->

<!-- About Section -->
<section id="about" class="about section">

  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <img src="{{ asset('template-landing/assets/img/img_long_5.jpg') }}"
            alt="BUP Genteng"
            class="img-fluid">
        </div>
        <div class=" col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
          <h3 class="content-subtitle text-white opacity-50">Tentang Kami</h3>
          <h2 class="content-title mb-4">
            {{ $profil->nama_balai ?? 'Balai Usaha Perikanan Genteng' }}
          </h2>
          <p class="opacity-50">
            {{ Str::limit($profil->sejarah ?? 'Profil balai belum diisi oleh admin.', 350) }}
          </p>

          <div class="row my-5">
            <div class="col-lg-12 d-flex align-items-start mb-4">
              <i class="bi bi-cloud-rain me-4 display-6"></i>
              <div>
                <h4 class="m-0 h5 text-white">Bibit Ikan Berkualitas</h4>
                <p class="text-white opacity-50">Bibit ikan yang tersedia dikelola dengan memperhatikan kondisi stok, kesehatan, dan kebutuhan pemesanan masyarakat.</p>
              </div>
            </div>
            <div class="col-lg-12 d-flex align-items-start mb-4">
              <i class="bi bi-heart me-4 display-6"></i>
              <div>
                <h4 class="m-0 h5 text-white">Pemesanan Mudah</h4>
                <p class="text-white opacity-50">Masyarakat dapat melakukan pemesanan bibit ikan secara online dan admin akan melakukan konfirmasi melalui WhatsApp.</p>
              </div>
            </div>
            <div class="col-lg-12 d-flex align-items-start">
              <i class="bi bi-shop me-4 display-6"></i>
              <div>
                <h4 class="m-0 h5 text-white">Pengelolaan Kolam</h4>
                <p class="text-white opacity-50">Kegiatan budidaya dilakukan melalui pengelolaan kolam yang teratur untuk mendukung pertumbuhan bibit ikan secara optimal.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /About Section -->

<!-- Testimonials Section -->
<section class="testimonials-12 testimonials section" id="testimonials">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>TESTIMONIALS</h2>
    <p>Apa Kata Mereka Tentang Layanan Kami</p>
  </div><!-- End Section Title -->

  <div class="testimonial-wrap">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-4 mb-md-4">
          <div class="testimonial">
            <img src="{{ asset('template-landing/assets/img/testimonials/testimonials-1.jpg') }}" alt="Testimonial author">
            <blockquote>
              <p>
                “Informasi bibit ikan menjadi lebih mudah diakses. Saya bisa mengetahui stok yang tersedia sebelum melakukan pemesanan.”
              </p>
            </blockquote>
            <p class="client-name">Andi Mahmud</p>
          </div>
        </div>
        <div class="col-md-6 mb-4 mb-md-4">
          <div class="testimonial">
            <img src="{{ asset('template-landing/assets/img/testimonials/testimonials-2.jpg') }}" alt="Testimonial author">
            <blockquote>
              <p>
                “Proses pemesanan lebih praktis karena cukup mengisi form, lalu admin menghubungi melalui WhatsApp untuk konfirmasi.”
              </p>
            </blockquote>
            <p class="client-name">Nanda Afifa</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /Testimonials Section -->

@endsection