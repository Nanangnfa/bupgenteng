@extends('layouts.admin')

@section('title', 'Data Monitoring')
@section('breadcrumb', 'Monitoring')
@section('page-title', 'Data Monitoring')
@section('page-description', 'Kelola data monitoring stok dan kondisi bibit ikan.')
@section('page-icon', 'bi bi-clipboard-data')

@section('content')

<section class="panel mt-3">

  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title">
        <span>Daftar Monitoring</span>
      </h2>
    </div>

    <div class="d-flex gap-2">
      <input class="form-control form-control-sm table-search"
        type="search"
        placeholder="Cari monitoring..."
        data-table-search="monitoringTable"
        aria-label="Cari monitoring">

      <a href="{{ route('admin.monitoring.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle"></i>
        Tambah
      </a>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table align-middle mb-0" id="monitoringTable" data-searchable-table>
      <thead>
        <tr>
          <th>No</th>
          <th>Bibit</th>
          <th>Tanggal</th>
          <th>Jumlah Mati</th>
          <th>Stok Setelah Monitoring</th>
          <th>Catatan</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($monitorings as $monitoring)
        <tr>
          <td>{{ $loop->iteration }}</td>

          <td class="fw-semibold">
            {{ $monitoring->bibit->kode_bibit ?? '-' }} -
            {{ $monitoring->bibit->nama_ikan ?? '-' }}
          </td>

          <td>{{ $monitoring->tanggal_monitoring }}</td>

          <td>{{ $monitoring->jumlah_mati }}</td>

          <td>{{ $monitoring->stok_akhir }}</td>

          <td>
            @if ($monitoring->catatan)
            <button type="button"
              class="btn fw-normal p-0 text-decoration-none"
              data-bs-toggle="modal"
              data-bs-target="#catatanMonitoring{{ $monitoring->id }}">
              {{ \Illuminate\Support\Str::words($monitoring->catatan, 3, '...') }}
            </button>
            @else
            -
            @endif
          </td>

          <td class="text-end">
            <a href="{{ route('admin.monitoring.edit', $monitoring->id) }}"
              class="btn btn-light btn-sm">
              Edit
            </a>

            <button type="button"
              class="btn btn-danger btn-sm"
              data-bs-toggle="modal"
              data-bs-target="#hapusMonitoring{{ $monitoring->id }}">
              Hapus
            </button>
          </td>
        </tr>

        {{-- Modal Lihat Catatan --}}
        <div class="modal fade"
          id="catatanMonitoring{{ $monitoring->id }}"
          tabindex="-1"
          aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-header">
                <h2 class="modal-title h5">
                  Catatan Monitoring
                </h2>

                <button type="button"
                  class="btn-close"
                  data-bs-dismiss="modal">
                </button>
              </div>

              <div class="modal-body">
                <p class="mb-0">
                  {{ $monitoring->catatan }}
                </p>
              </div>

              <div class="modal-footer">
                <button type="button"
                  class="btn btn-outline-secondary"
                  data-bs-dismiss="modal">
                  Tutup
                </button>
              </div>

            </div>
          </div>
        </div>

        <div class="modal fade"
          id="hapusMonitoring{{ $monitoring->id }}"
          tabindex="-1"
          aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-header">
                <h2 class="modal-title h5">
                  Konfirmasi Hapus
                </h2>

                <button type="button"
                  class="btn-close"
                  data-bs-dismiss="modal">
                </button>
              </div>

              <div class="modal-body">
                Yakin ingin menghapus data monitoring ini?
              </div>

              <div class="modal-footer">
                <button type="button"
                  class="btn btn-outline-secondary"
                  data-bs-dismiss="modal">
                  Batal
                </button>

                <form action="{{ route('admin.monitoring.destroy', $monitoring->id) }}"
                  method="POST">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="btn btn-danger">
                    Hapus
                  </button>
                </form>
              </div>

            </div>
          </div>
        </div>
        @empty
        <tr>
          <td colspan="7" class="text-center text-muted">
            Belum ada data monitoring.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</section>

@endsection