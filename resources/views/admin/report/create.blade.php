@extends('layouts.admin')

@section('title', 'Create Report')
@section('breadcrumb', 'Report')
@section('page-title', 'Create Report')
@section('page-description', 'Pilih bulan dan tahun untuk membuat laporan produksi bibit.')
@section('page-icon', 'bi bi-file-earmark-spreadsheet')

@section('content')

<section class="panel mt-3">

  <div class="mb-4">
    <h2 class="h5 mb-1 section-title">
      <span>Laporan Bulanan</span>
    </h2>
  </div>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('admin.report.export') }}" method="GET">

    <div class="row g-3">

      <div class="col-md-6">
        <label class="form-label">Bulan</label>
        <select name="bulan" class="form-select" required>
          <option value="">-- Pilih Bulan --</option>
          <option value="1" {{ request('bulan') == 1 ? 'selected' : '' }}>Januari</option>
          <option value="2" {{ request('bulan') == 2 ? 'selected' : '' }}>Februari</option>
          <option value="3" {{ request('bulan') == 3 ? 'selected' : '' }}>Maret</option>
          <option value="4" {{ request('bulan') == 4 ? 'selected' : '' }}>April</option>
          <option value="5" {{ request('bulan') == 5 ? 'selected' : '' }}>Mei</option>
          <option value="6" {{ request('bulan') == 6 ? 'selected' : '' }}>Juni</option>
          <option value="7" {{ request('bulan') == 7 ? 'selected' : '' }}>Juli</option>
          <option value="8" {{ request('bulan') == 8 ? 'selected' : '' }}>Agustus</option>
          <option value="9" {{ request('bulan') == 9 ? 'selected' : '' }}>September</option>
          <option value="10" {{ request('bulan') == 10 ? 'selected' : '' }}>Oktober</option>
          <option value="11" {{ request('bulan') == 11 ? 'selected' : '' }}>November</option>
          <option value="12" {{ request('bulan') == 12 ? 'selected' : '' }}>Desember</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Tahun</label>
        <input type="number"
          name="tahun"
          class="form-control"
          value="{{ request('tahun', date('Y')) }}"
          min="2020"
          max="2100"
          required>
      </div>

    </div>

    <div class="d-flex justify-content-end gap-2 mt-4">
      <a href="{{ route('admin.dashboard') }}" class="btn btn-light">
        Kembali
      </a>

      <button type="submit" class="btn btn-primary">
        <i class="bi bi-download"></i>
        Export Excel
      </button>
    </div>

  </form>

</section>

@endsection