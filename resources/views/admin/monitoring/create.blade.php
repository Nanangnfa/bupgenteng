@extends('layouts.admin')

@section('title', 'Tambah Monitoring')
@section('breadcrumb', 'Monitoring')
@section('page-title', 'Tambah Monitoring')
@section('page-description', 'Tambah data monitoring bibit ikan.')
@section('page-icon', 'bi bi-plus-circle')

@section('content')

<section class="row g-3">
  <div class="col-12 col-xl-12">

    <form action="{{ route('admin.monitoring.store') }}" method="POST" class="panel">
      @csrf

      <div class="panel-header">
        <div>
          <h2 class="h5 mb-1 section-title">
            <span>Form Monitoring</span>
          </h2>

          <p class="text-muted mb-0">
            Isi data monitoring stok bibit ikan.
          </p>
        </div>
      </div>

      <div class="row g-3">

        <div class="col-md-12">
          <label class="form-label">Pilih Bibit</label>
          <select name="bibit_id" id="bibit_id" class="form-select" required>
            <option value="" data-stok="0">-- Pilih Bibit --</option>

            @foreach ($bibits as $bibit)
            <option value="{{ $bibit->id }}"
              data-stok="{{ $bibit->stok_sekarang }}"
              {{ old('bibit_id') == $bibit->id ? 'selected' : '' }}>
              {{ $bibit->kode_bibit }} - {{ $bibit->nama_ikan }}
              | Stok: {{ $bibit->stok_sekarang }} 
            </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Tanggal Monitoring</label>
          <input type="date"
            name="tanggal_monitoring"
            class="form-control"
            value="{{ old('tanggal_monitoring') }}"
            required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Jumlah Mati</label>
          <input type="number"
            name="jumlah_mati"
            id="jumlah_mati"
            class="form-control"
            value="{{ old('jumlah_mati', 0) }}"
            min="0"
            step="1"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            required>

          <small id="stokHelp" class="text-muted">
            Pilih bibit terlebih dahulu.
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
            value="{{ old('stok_akhir') }}"
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
            rows="4">{{ old('catatan') }}</textarea>
        </div>

      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.monitoring.index') }}"
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
    const bibitSelect = document.getElementById('bibit_id');
    const jumlahMatiInput = document.getElementById('jumlah_mati');
    const stokAkhirInput = document.getElementById('stok_akhir');
    const stokHelp = document.getElementById('stokHelp');
    const jumlahMatiError = document.getElementById('jumlahMatiError');

    function formatNumber(value) {
      if (Number.isInteger(value)) {
        return value;
      }

      return value.toFixed(2);
    }

    function hitungStokAkhir() {
      const selectedOption = bibitSelect.options[bibitSelect.selectedIndex];
      const stokAwal = parseFloat(selectedOption.getAttribute('data-stok')) || 0;
      let jumlahMati = parseInt(jumlahMatiInput.value) || 0;
      
      stokHelp.textContent = 'Stok tersedia: ' + formatNumber(stokAwal) + ' Kg';
      jumlahMatiInput.max = stokAwal;

      if (jumlahMati > stokAwal) {
        jumlahMati = stokAwal;
        jumlahMatiInput.value = formatNumber(stokAwal);
        jumlahMatiError.classList.remove('d-none');
      } else {
        jumlahMatiError.classList.add('d-none');
      }

      const stokAkhir = stokAwal - jumlahMati;
      stokAkhirInput.value = formatNumber(stokAkhir);
    }

    bibitSelect.addEventListener('change', function() {
      jumlahMatiInput.value = 0;
      hitungStokAkhir();
    });

    jumlahMatiInput.addEventListener('input', hitungStokAkhir);

    if (bibitSelect.value) {
      hitungStokAkhir();
    }
  });
</script>

@endsection