@extends('layouts.landing')

@section('body-class', 'services-page')

@section('content')

@php
$pageTitleBg = asset('template-landing/assets/img/hero_1.jpg');
@endphp

<div class="page-title dark-background" data-aos="fade"
  style="background-image: url('{{ $pageTitleBg }}');">
  <div class="container position-relative">
    <h1>Visi dan Misi</h1>
    <p>Arah tujuan dan komitmen Balai Usaha Perikanan Genteng</p>

    <nav class="breadcrumbs">
      <ol>
        <li><a href="{{ route('landing.index') }}">Dashboard</a></li>
        <li class="current">Visi Misi</li>
      </ol>
    </nav>
  </div>
</div>

<section class="services section">

  <div class="container section-title" data-aos="fade-up">
    <p>Visi dan Misi Kami</p>
  </div>

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-6">
        <div class="service-item">
          <div class="service-item-content">
            <h3 class="service-heading">Visi</h3>
            <p>
              {{ $profil->visi ?? 'Visi belum diisi oleh admin.' }}
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="service-item">
          <div class="service-item-content">
            <h3 class="service-heading">Misi</h3>
            <p>
              {{ $profil->misi ?? 'Misi belum diisi oleh admin.' }}
            </p>
          </div>
        </div>
      </div>

    </div>

  </div>

</section>

@endsection