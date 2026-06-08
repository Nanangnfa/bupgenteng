@extends('layouts.landing')

@section('body-class', 'about-page')

@section('content')

@php
$pageTitleBg = asset('template-landing/assets/img/hero_1.jpg');
@endphp

<div class="page-title dark-background" data-aos="fade"
  style="background-image: url('{{ $pageTitleBg }}');">
  <div class="container position-relative">
    <h1>Profil Balai</h1>
    <p>Informasi profil Balai Usaha Perikanan Genteng</p>

    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ route('landing.index') }}">Dashboard</a></li>
        <li class="current">Profil</li>
      </ol>
    </nav>
  </div>
</div>

<section class="about section">
  <div class="container" data-aos="fade-up">

    <div class="row gy-4 align-items-center">

      <div class="col-lg-6">
        <img src="{{ asset('template-landing/assets/img/img_long_5.jpg') }}"
          class="img-fluid"
          alt="Profil Balai">
      </div>

      <div class="col-lg-6 text-dark">
        <h2 class="text-dark">
          {{ $profil->nama_balai ?? 'Balai Usaha Perikanan Genteng' }}
        </h2>

        <p class="text-dark">
          {{ $profil->sejarah ?? 'Profil balai belum diisi oleh admin.' }}
        </p>

        <p class="text-dark">
          <strong>Alamat:</strong><br>
          {{ $profil->alamat ?? '-' }}
        </p>

        <p class="text-dark">
          <strong>Telepon:</strong><br>
          {{ $profil->telepon ?? '-' }}
        </p>

        <p class="text-dark">
          <strong>Email:</strong><br>
          {{ $profil->email ?? '-' }}
        </p>
      </div>

    </div>

  </div>
</section>

@endsection