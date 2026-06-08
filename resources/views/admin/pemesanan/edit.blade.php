@extends('layouts.admin')

@section('title', 'Ubah Status Pemesanan')
@section('breadcrumb', 'Pemesanan')
@section('page-title', 'Ubah Status Pemesanan')
@section('page-description', 'Admin hanya mengubah status pemesanan customer.')
@section('page-icon', 'bi bi-pencil-square')

@section('content')

<section class="row g-3">

  <div class="col-12 col-xl-5">
    <div class="panel h-100">

      <h2 class="h5 mb-3 section-title">
        <i class="bi bi-info-circle"></i>
        <span>Detail Pemesanan</span>
      </h2>

      <p>
        <strong>Kode Pemesanan:</strong><br>
        {{ $pemesanan->kode_pemesanan }}
      </p>

      <p>
        <strong>Bibit:</strong><br>
        {{ $pemesanan->bibit->kode_bibit ?? '-' }} -
        {{ $pemesanan->bibit->nama_ikan ?? '-' }}
      </p>

      <p>
        <strong>Nama Customer:</strong><br>
        {{ $pemesanan->nama_customer }}
      </p>

      <p>
        <strong>No WhatsApp:</strong><br>
        {{ $pemesanan->no_whatsapp }}
      </p>

      <p>
        <strong>Alamat:</strong><br>
        {{ $pemesanan->alamat ?? '-' }}
      </p>

      <p>
        <strong>Jumlah Pesan:</strong><br>
        {{ $pemesanan->jumlah_pesan }}
      </p>

      <p>
        <strong>Catatan:</strong><br>
        {{ $pemesanan->catatan ?? '-' }}
      </p>

    </div>
  </div>

  <div class="col-12 col-xl-7">

    <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}"
      method="POST"
      class="panel">

      @csrf
      @method('PUT')

      <div class="panel-header">
        <div>
          <h2 class="h5 mb-1 section-title">
            <span>Form Status</span>
          </h2>

          <p class="text-muted mb-0">
            Pilih status terbaru untuk pemesanan ini.
          </p>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Status Pemesanan</label>

        <select name="status" class="form-select" required>
          <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>
            Pending
          </option>

          <option value="disetujui" {{ $pemesanan->status == 'disetujui' ? 'selected' : '' }}>
            Disetujui
          </option>

          <option value="ditolak" {{ $pemesanan->status == 'ditolak' ? 'selected' : '' }}>
            Ditolak
          </option>

          <option value="selesai" {{ $pemesanan->status == 'selesai' ? 'selected' : '' }}>
            Selesai
          </option>
        </select>

        @error('status')
        <div class="text-danger small mt-1">
          {{ $message }}
        </div>
        @enderror
      </div>

      <div class="alert alert-info">
        Perubahan status hanya berlaku di sistem admin. Konfirmasi ke customer tetap dilakukan melalui WhatsApp.
      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.pemesanan.index') }}"
          class="btn btn-outline-secondary">
          Kembali
        </a>

        <button type="submit" class="btn btn-primary">
          <i class="bi bi-save"></i>
          Simpan Status
        </button>
      </div>

    </form>

  </div>

</section>

@endsection