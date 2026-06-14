@extends('layouts.landing')

@section('body-class', 'contact-page')

@section('content')

@php
$pageTitleBg = asset('template-landing/assets/img/hero_1.jpg');
@endphp

<div class="page-title dark-background" data-aos="fade"
  style="background-image: url('{{ $pageTitleBg }}');">
  <div class="container position-relative">
    <h1>Form Pemesanan</h1>
    <p>Isi form pemesanan bibit ikan, admin akan menghubungi melalui WhatsApp</p>

    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ route('landing.index') }}">Dashboard</a></li>
        <li class="current">Pemesanan</li>
      </ol>
    </nav>
  </div>
</div>>

<section id="contact" class="contact section">

  <div class="container" data-aos="fade">

    @if (session('success'))
    <div class="alert alert-success mb-4">
      {{ session('success') }}
    </div>
    @endif

    <div class="row gy-5 gx-lg-5">

      <div class="col-lg-4">

        <div class="info">
          <h3>Informasi Pemesanan</h3>

          <p>
            Silakan isi data pemesanan bibit ikan.
            Admin akan melakukan konfirmasi melalui WhatsApp.
          </p>

          <div class="info-item d-flex">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h4>Alamat:</h4>
              <p>{{ $profil->alamat ?? '-' }}</p>
            </div>
          </div>

          <div class="info-item d-flex">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h4>Email:</h4>
              <p>{{ $profil->email ?? '-' }}</p>
            </div>
          </div>

          <div class="info-item d-flex">
            <i class="bi bi-phone flex-shrink-0"></i>
            <div>
              <h4>Telepon:</h4>
              <p>{{ $profil->telepon ?? '-' }}</p>
            </div>
          </div>

        </div>

      </div>

      <div class="col-lg-8">

        <form action="{{ route('landing.pemesanan.store') }}" method="POST" class="php-email-form">
          @csrf

          <div class="form-group mb-3">
            <select name="bibit_id" class="form-control" required>
              <option value="">-- Pilih Bibit Ikan --</option>

              @foreach ($bibits as $bibit)
              <option value="{{ $bibit->id }}">
                {{ $bibit->nama_ikan }}
                | Ukuran: {{ $bibit->ukuran ?? '-' }} Cm
                | Harga: {{ $bibit->harga ? 'Rp ' . number_format($bibit->harga, 0, ',', '.') : '-' }}
                | Stok: {{ $bibit->stok_sekarang }} 
              </option>
              @endforeach
            </select>
          </div>

          <div class="form-group mb-3">
            <input type="text"
              name="nama_customer"
              class="form-control"
              placeholder="Nama Lengkap"
              required>
          </div>

          <div class="form-group mb-3">
            <input type="text"
              name="no_whatsapp"
              class="form-control"
              placeholder="No WhatsApp, contoh: 628123456789"
              required>
          </div>

          <div class="form-group mb-3">
            <input name="alamat"
              class="form-control"
              placeholder="Alamat lengkap"
              required>
          </div>

          <div class="form-group mb-3">
            <input type="number" min="0"
              name="jumlah_pesan"
              class="form-control"
              placeholder="Jumlah pesan dengan satuan"
              required>
          </div>

          <div class="form-group mb-3">
            <textarea name="catatan"
              class="form-control"
              placeholder="Catatan tambahan"></textarea>
          </div>

          <div class="text-center">
            <button type="submit">
              Kirim Pemesanan
            </button>
          </div>

        </form>

      </div>

    </div>

  </div>

</section>

@endsection