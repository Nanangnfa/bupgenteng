@extends('layouts.admin')

@section('title', 'Profil Balai')
@section('breadcrumb', 'Profil')
@section('page-title', 'Profil Balai')
@section('page-description', 'Kelola informasi profil, visi, misi, alamat, dan kontak balai.')
@section('page-icon', 'bi bi-building')

@section('content')

@if (session('success'))
<div class="alert alert-success mt-3">
  {{ session('success') }}
</div>
@endif

<section class="row g-3 mt-1">

  <div class="col-12 col-xl-8">

    <form action="{{ route('admin.profil-balai.update') }}"
      method="POST"
      class="panel">

      @csrf
      @method('PUT')

      <div class="panel-header">
        <div>
          <h2 class="h5 mb-1 section-title">
            <span>Form Profil Balai</span>
          </h2>
        </div>
      </div>

      <div class="row g-3">

        <div class="col-12">
          <label class="form-label">Nama Balai</label>
          <input type="text"
            name="nama_balai"
            class="form-control"
            value="{{ old('nama_balai', $profil->nama_balai) }}">
        </div>

        <div class="col-12">
          <label class="form-label">Sejarah / Profil</label>
          <textarea name="sejarah"
            class="form-control"
            rows="5">{{ old('sejarah', $profil->sejarah) }}</textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Visi</label>
          <textarea name="visi"
            class="form-control"
            rows="4">{{ old('visi', $profil->visi) }}</textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Misi</label>
          <textarea name="misi"
            class="form-control"
            rows="4">{{ old('misi', $profil->misi) }}</textarea>
        </div>

        <div class="col-12">
          <label class="form-label">Alamat</label>
          <textarea name="alamat"
            class="form-control"
            rows="3">{{ old('alamat', $profil->alamat) }}</textarea>
        </div>

        <div class="col-md-6">
          <label class="form-label">Telepon</label>
          <input type="text"
            name="telepon"
            class="form-control"
            value="{{ old('telepon', $profil->telepon) }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email"
            name="email"
            class="form-control"
            value="{{ old('email', $profil->email) }}">
        </div>

        <div class="col-12">
          <label class="form-label">Link Google Maps</label>
          <input type="text"
            name="maps"
            class="form-control"
            value="{{ old('maps', $profil->maps) }}">
        </div>

      </div>

      <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-save"></i>
          Simpan Profil
        </button>
      </div>

    </form>

  </div>

  <div class="col-12 col-xl-4">
    <div class="panel h-100">

      <h2 class="h5 mb-3 section-title">
        <span>Preview Data Profil</span>
      </h2>

      <div class="mb-3">
        <small class="text-muted">Nama Balai</small>
        <p class="fw-semibold mb-0">
          {{ $profil->nama_balai ?? '-' }}
        </p>
      </div>

      <div class="mb-3">
        <small class="text-muted">Sejarah / Profil</small>
        <p class="mb-0" style="text-align: justify;">
          {{ $profil->sejarah ?? '-' }}
        </p>
      </div>

      <div class="mb-3">
        <small class="text-muted">Visi</small>
        <p class="mb-0" style="text-align: justify;">
          {{ $profil->visi ?? '-' }}
        </p>
      </div>

      <div class="mb-3">
        <small class="text-muted">Misi</small>
        <p class="mb-0" style="text-align: justify;">
          {{ $profil->misi ?? '-' }}
        </p>
      </div>

      <div class="mb-3">
        <small class="text-muted">Alamat</small>
        <p class="mb-0" style="text-align: justify;">
          {{ $profil->alamat ?? '-' }}
        </p>
      </div>

      <div class="mb-3">
        <small class="text-muted">Telepon</small>
        <p class="mb-0">
          {{ $profil->telepon ?? '-' }}
        </p>
      </div>

      <div class="mb-3">
        <small class="text-muted">Email</small>
        <p class="mb-0">
          {{ $profil->email ?? '-' }}
        </p>
      </div>

      <div class="mb-3">
        <small class="text-muted">Link Google Maps</small>

        @if ($profil->maps)
        <p class="mb-0" style="text-align: justify; word-break: break-all;">
          {{ $profil->maps }}
        </p>
        @else
        <p class="mb-0">-</p>
        @endif
      </div>

      <div class="alert alert-info mt-3 mb-0" style="text-align: justify;">
        Data profil ini akan ditampilkan pada halaman publik seperti Profil, Visi Misi, Form Pemesanan, dan footer landing page.
      </div>

    </div>

  </div>

</section>

@endsection