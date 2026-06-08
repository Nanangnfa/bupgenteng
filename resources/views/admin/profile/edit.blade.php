@extends('layouts.admin')

@section('title', 'Profile Admin')
@section('breadcrumb', 'Akun')
@section('page-title', 'Profile Admin')
@section('page-description', 'Kelola nama, email, dan password akun admin.')
@section('page-icon', 'bi bi-person-badge')

@section('content')

@if (session('status') == 'profile-updated')
<div class="alert alert-success mt-3">
  Profile berhasil diperbarui.
</div>
@endif

<section class="row g-3 mt-1">
  <div class="col-12 col-xl-7">

    <form action="{{ route('admin.profile.update') }}" method="POST" class="panel">
      @csrf
      @method('PATCH')

      <div class="panel-header">
        <div>
          <h2 class="h5 mb-1 section-title">
            <span>Informasi Akun</span>
          </h2>

          <p class="text-muted mb-0">
            Ubah nama, email, atau password akun admin.
          </p>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text"
          name="name"
          class="form-control"
          value="{{ old('name', $user->name) }}"
          required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email"
          name="email"
          class="form-control"
          value="{{ old('email', $user->email) }}"
          required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <input type="password"
          name="password"
          class="form-control"
          placeholder="Kosongkan jika tidak ingin mengganti password">
      </div>

      <div class="mb-3">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input type="password"
          name="password_confirmation"
          class="form-control">
      </div>

      <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-save"></i>
          Simpan Perubahan
        </button>
      </div>
    </form>

  </div>

  <div class="col-12 col-xl-5">
    <div class="panel h-100">
      <h2 class="h5 mb-3 section-title">
        <span>Data Login</span>
      </h2>

      <p>
        <strong>Nama:</strong><br>
        {{ $user->name }}
      </p>

      <p>
        <strong>Email:</strong><br>
        {{ $user->email }}
      </p>

      <p>
        <strong>Akun Dibuat:</strong><br>
        {{ $user->created_at }}
      </p>

      <div class="alert alert-info mb-0">
        Password hanya berubah jika kolom password baru diisi.
      </div>
    </div>
  </div>
</section>

@endsection