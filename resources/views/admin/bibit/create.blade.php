@extends('layouts.admin')

@section('title', 'Tambah Bibit')
@section('breadcrumb', 'Data Master')
@section('page-title', 'Tambah Bibit')
@section('page-description', 'Tambah data bibit ikan baru.')
@section('page-icon', 'bi bi-plus-circle')

@section('content')

<section class="row g-3">
  <div class="col-12 col-xl-12">

    <form action="{{ route('admin.bibit.store') }}"
      method="POST"
      class="panel">

      @csrf

      <div class="panel-header">
        <div>
          <h2 class="h5 mb-1 section-title">
            <span>Form Bibit</span>
          </h2>

          <p class="text-muted mb-0">
            Isi data bibit ikan sesuai data lapangan.
          </p>
        </div>
      </div>

      <div class="row g-3">

        <div class="col-md-6">
          <label class="form-label">Kode Bibit</label>
          <input type="text"
            name="kode_bibit"
            class="form-control"
            value="{{ old('kode_bibit') }}"
            required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Nama Ikan</label>
          <input type="text"
            name="nama_ikan"
            class="form-control"
            value="{{ old('nama_ikan') }}"
            required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Tanggal Tebar</label>
          <input type="date"
            name="tanggal_tebar"
            class="form-control"
            value="{{ old('tanggal_tebar') }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Jumlah Awal</label>
          <input type="number"
            name="jumlah_awal"
            id="jumlah_awal"
            class="form-control bg-light"
            value="{{ old('jumlah_awal') }}"
            readonly>

          <small class="text-muted">
            Otomatis Terisi Dari Stok Sekarang
          </small>
        </div>

        <div class="col-md-6">
          <label class="form-label">Stok Sekarang</label>
          <input type="number"
            name="stok_sekarang"
            id="stok_sekarang"
            class="form-control"
            value="{{ old('stok_sekarang') }}"
            min="0"
            step="1"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Status</label>
          <select name="status" class="form-select" required>
            <option value="tersedia">Tersedia</option>
            <option value="habis">Habis</option>
          </select>
        </div>

        <div class="col-12">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi"
            class="form-control"
            rows="4">{{ old('deskripsi') }}</textarea>
        </div>

      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.bibit.index') }}"
          class="btn btn-outline-secondary">
          Kembali
        </a>

        <button type="submit" class="btn btn-primary">
          <i class="bi bi-save"></i>
          Simpan
        </button>
      </div>

    </form>

  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const stokSekarangInput = document.getElementById('stok_sekarang');
    const jumlahAwalInput = document.getElementById('jumlah_awal');

    function isiJumlahAwal() {
      jumlahAwalInput.value = stokSekarangInput.value;
    }

    stokSekarangInput.addEventListener('input', isiJumlahAwal);

    isiJumlahAwal();
  });
</script>

@endsection