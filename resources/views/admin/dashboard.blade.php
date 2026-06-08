@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan data bibit, monitoring, dan pemesanan.')
@section('page-icon', 'bi bi-speedometer2')

@section('content')


<div class="d-flex justify-content-end mb-3" style="position: relative; top: -75px;">
  <a href="{{ route('admin.report.create') }}" class="btn btn-primary">
    <i class="bi bi-file-earmark-plus"></i> Create Report
  </a>
</div>

<section class="row g-3" style="position: relative; top: -40px;">
  <div class="col-12 col-sm-6 col-xl-3">
    <article class="metric-card metric-primary">
      <div class="metric-top">
        <span class="metric-label">Total Bibit</span>
        <span class="metric-icon"><i class="bi bi-box-seam"></i></span>
      </div>
      <div class="metric-value">{{ $totalBibit ?? 0 }}</div>
      <div class="metric-meta">
        <span>data bibit ikan</span>
      </div>
    </article>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <article class="metric-card metric-success">
      <div class="metric-top">
        <span class="metric-label">Total Stok</span>
        <span class="metric-icon"><i class="bi bi-stack"></i></span>
      </div>
      <div class="metric-value">{{ $totalStok ?? 0 }}</div>
      <div class="metric-meta">
        <span>stok bibit tersedia</span>
      </div>
    </article>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <article class="metric-card metric-warning">
      <div class="metric-top">
        <span class="metric-label">Pesanan Pending</span>
        <span class="metric-icon"><i class="bi bi-cart-check"></i></span>
      </div>
      <div class="metric-value">{{ $pesananPending ?? 0 }}</div>
      <div class="metric-meta">
        <span>menunggu proses admin</span>
      </div>
    </article>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <article class="metric-card metric-danger">
      <div class="metric-top">
        <span class="metric-label">Monitoring</span>
        <span class="metric-icon"><i class="bi bi-clipboard-data"></i></span>
      </div>
      <div class="metric-value">{{ $totalMonitoring ?? 0 }}</div>
      <div class="metric-meta">
        <span>catatan monitoring</span>
      </div>
    </article>
  </div>
</section>

<section class="panel" style="position: relative; top: -20px;">
  <div class=" panel-header">
  <div>
    <h2 class="h5 mb-1 section-title fw-bold">
      <span>Informasi Sistem</span>
    </h2>
    <p class="text-muted mb-0">
      Gunakan menu di sidebar untuk mengelola data.
    </p>
  </div>
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <a href="{{ route('admin.bibit.index') }}" class="btn btn-primary w-100">
        Kelola Bibit
      </a>
    </div>

    <div class="col-md-4">
      <a href="{{ route('admin.monitoring.index') }}" class="btn btn-success w-100">
        Monitoring
      </a>
    </div>

    <div class="col-md-4">
      <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-warning w-100">
        Pemesanan
      </a>
    </div>
  </div>
</section>

@endsection