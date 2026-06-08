@extends('layouts.admin')

@section('title', 'Profile Admin')
@section('breadcrumb', 'Profile')
@section('page-title', 'Profile')
@section('page-description', 'Lihat dan ubah informasi akun admin Anda.')
@section('page-icon', 'bi bi-person-badge')

@section('content')
<div class="row">
  <div class="col-md-6">
    <form action="{{ route('admin.profile.update') }}" method="POST" class="panel needs-validation" novalidate>
      @csrf
      @method('PATCH')

      <div class="panel-header mb-3">
        <h2 class="h5 mb-1 section-title"><i class="bi bi-person-badge"></i> Profile Info</h2>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
        <div class="invalid-feedback">Nama harus diisi.</div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
        <div class="invalid-feedback">Email harus valid.</div>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password Baru <small>(kosongkan jika tidak ingin ganti)</small></label>
        <input type="password" name="password" id="password" class="form-control">
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-circle"></i> Update
      </button>
    </form>
  </div>
</div>
@endsection