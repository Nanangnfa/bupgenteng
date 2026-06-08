@extends('layouts.admin')

@section('title', 'Edit Monitoring')
@section('breadcrumb', 'Monitoring')
@section('page-title', 'Edit Monitoring')
@section('page-description', 'Ubah data monitoring bibit ikan.')
@section('page-icon', 'bi bi-pencil-square')

@section('content')

<section class="row g-3">
  <div class="col-12 col-xl-12">

    <form action="{{ route('admin.monitoring.update', $monitoring->id) }}" method="POST" class="panel">
      @csrf
      @method('PUT')

      <div class="panel-header">
        <div>
          <h2 class="h5 mb-1 section-title">
            <span>Form Edit Monitoring</span>
          </h2>

          <p class="text-muted mb-0">
            Perbarui data monitoring bibit ikan.
          </p>
        </div>
      </div>

      <div class="row g-3">

        <div class="col-md-12">
          <label class="form-label">Pilih Bibit</label>

          <input type="hidden" name="bibit_id" id="bibit_id" value="{{ $monitoring->bibit_id }}">

          @php
          $bibitAktif = $bibits->firstWhere('id', $monitoring->bibit_id);
          $stokDasar = $bibitAktif
          ? $bibitAktif->stok_sekarang + $monitoring->jumlah_mati
          : 0;
          @endphp

          <input type="text"
            class="form-control bg-light"
            value="{{ $bibitAktif->kode_bibit ?? '-' }} - {{ $bibitAktif->nama_ikan ?? '-' }} | Stok: {{ $stokDasar }} Kg"
            readonly>

          <input type="hidden" id="stok_dasar" value="{{ $stokDasar }}">
        </div>

        <div class="col-md-6">
          <label class="form-label">Tanggal Monitoring</label>
          <input type="date"
            name="tanggal_monitoring"
            class="form-control"
            value="{{ old('tanggal_monitoring', $monitoring->tanggal_monitoring) }}"
            required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Jumlah Mati</label>
          <input type="number"
            name="jumlah_mati"
            id="jumlah_mati"
            class="form-control"
            value="{{ old('jumlah_mati', $monitoring->jumlah_mati) }}"
            min="0"
            step="0.01"
            required>

          <small id="stokHelp" class="text-muted">
            Stok tersedia akan muncul setelah bibit dipilih.
          </small>

          <div id="jumlahMatiError" class="text-danger small mt-1 d-none">
            Jumlah mati tidak boleh melebihi stok tersedia.
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">Stok Setelah Monitoring</label>
          <input type="number"
            name="stok_akhir"
            id="stok_akhir"
            class="form-control bg-light"
            value="{{ old('stok_akhir', $monitoring->stok_akhir) }}"
            readonly
            required>

          <small class="text-muted">
            Stok Setelah Monitoring dihitung otomatis dari stok bibit dikurangi jumlah mati.
          </small>
        </div>

        <div class="col-12">
          <label class="form-label">Catatan</label>
          <textarea name="catatan"
            class="form-control"
            rows="4">{{ old('catatan', $monitoring->catatan) }}</textarea>
        </div>

      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.monitoring.index') }}"
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

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const bibitSelect = document.getElementById('bibit_id');
    const jumlahMatiInput = document.getElementById('jumlah_mati');
    const stokAkhirInput = document.getElementById('stok_akhir');
    const stokHelp = document.getElementById('stokHelp');
    const jumlahMatiError = document.getElementById('jumlahMatiError');

    function formatNumber(value) {
      value = Number(value);

      if (Number.isInteger(value)) {
        return value.toString();
      }

      return value.toFixed(2).replace(/\.?0+$/, '');
    }

    function hitungStokAkhir() {
      const selectedOption = bibitSelect.options[bibitSelect.selectedIndex];
      const stokDasar = parseFloat(selectedOption.getAttribute('data-stok')) || 0;

      let jumlahMati = parseFloat(jumlahMatiInput.value) || 0;

      stokHelp.textContent = 'Stok tersedia: ' + formatNumber(stokDasar) + ' Kg';
      jumlahMatiInput.max = stokDasar;

      if (jumlahMati > stokDasar) {
        jumlahMati = stokDasar;
        jumlahMatiInput.value = formatNumber(stokDasar);
        jumlahMatiError.classList.remove('d-none');
      } else {
        jumlahMatiError.classList.add('d-none');
      }

      const stokAkhir = stokDasar - jumlahMati;
      stokAkhirInput.value = formatNumber(stokAkhir);
    }

    bibitSelect.addEventListener('change', function() {
      jumlahMatiInput.value = 0;
      hitungStokAkhir();
    });

    jumlahMatiInput.addEventListener('input', hitungStokAkhir);

    hitungStokAkhir();
  });
</script>

@endsection