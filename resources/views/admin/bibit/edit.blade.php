@extends('layouts.admin')

@section('title', 'Edit Bibit')
@section('breadcrumb', 'Data Master')
@section('page-title', 'Edit Bibit')
@section('page-description', 'Ubah data bibit ikan.')
@section('page-icon', 'bi bi-pencil-square')

@section('content')

<section class="row g-3">
  <div class="col-12 col-xl-12">

    <form action="{{ route('admin.bibit.update', $bibit->id) }}"
      method="POST"
      class="panel">

      @csrf
      @method('PUT')

      <div class="panel-header">
        <div>
          <h2 class="h5 mb-1 section-title">
            <span>Form Edit Bibit</span>
          </h2>

          <p class="text-muted mb-0">
            Perbarui data bibit ikan.
          </p>
        </div>
      </div>

      <div class="row g-3">

        <div class="col-md-6">
          <label class="form-label">Kode Bibit</label>
          <input type="text"
            name="kode_bibit"
            class="form-control"
            value="{{ old('kode_bibit', $bibit->kode_bibit) }}"
            required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Nama Ikan</label>
          <input type="text"
            name="nama_ikan"
            class="form-control"
            value="{{ old('nama_ikan', $bibit->nama_ikan) }}"
            required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Tanggal Tebar</label>
          <input type="date"
            name="tanggal_tebar"
            class="form-control"
            value="{{ old('tanggal_tebar', $bibit->tanggal_tebar) }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Jumlah Awal</label>
          <input type="number"
            name="jumlah_awal"
            class="form-control"
            value="{{ old('jumlah_awal', $bibit->jumlah_awal) }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Stok Sekarang</label>
          <input type="number"
            name="stok_sekarang"
            class="form-control"
            value="{{ old('stok_sekarang', $bibit->stok_sekarang) }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Status</label>

          <select name="status" class="form-select" required>
            <option value="tersedia"
              {{ $bibit->status == 'tersedia' ? 'selected' : '' }}>
              Tersedia
            </option>

            <option value="habis"
              {{ $bibit->status == 'habis' ? 'selected' : '' }}>
              Habis
            </option>
          </select>
        </div>

        <div class="col-12">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi"
            class="form-control"
            rows="4">{{ old('deskripsi', $bibit->deskripsi) }}</textarea>
        </div>

      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.bibit.index') }}"
          class="btn btn-outline-secondary">
          Kembali
        </a>

        <button type="submit" class="btn btn-primary">
          <i class="bi bi-save"></i>
          Update
        </button>
      </div>

    </form>

  </div>
</section>

@endsection