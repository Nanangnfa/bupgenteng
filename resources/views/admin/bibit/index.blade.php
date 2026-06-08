@extends('layouts.admin')

@section('title', 'Data Bibit')
@section('breadcrumb', 'Data Master')
@section('page-title', 'Data Bibit')
@section('page-description', 'Kelola data bibit ikan yang tersedia di BUP Genteng.')
@section('page-icon', 'bi bi-box-seam')

@section('content')

<section class="panel mt-3">



  <div class="d-flex justify-content-between align-items-center mb-4">

    <!-- Sisi Kiri -->
    <div>
      <h2 class="h5 mb-0 section-title">
        <span>Daftar Bibit</span>
      </h2>
    </div>

    <!-- Sisi Kanan (Sejajar) -->
    <div class="d-flex gap-2 align-items-center">
      <input class="form-control form-control-sm table-search"
        type="search"
        placeholder="Cari bibit..."
        data-table-search="bibitTable"
        aria-label="Cari bibit"
        style="max-width: 250px;"> <!-- Opsional: Batasi lebar input search -->

      <a href="{{ route('admin.bibit.create') }}" class="btn btn-primary btn-sm text-nowrap">
        <i class="bi bi-plus-circle"></i>
        Tambah Bibit
      </a>
    </div>

  </div>

  <div class="table-responsive">
    <table class="table align-middle mb-0" id="bibitTable" data-searchable-table>
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Bibit</th>
          <th>Nama Ikan</th>
          <th>Tanggal Tebar</th>
          <th>Jumlah Awal</th>
          <th>Stok Sekarang</th>
          <th>Status</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($bibits as $bibit)
        <tr>
          <td>{{ $loop->iteration }}</td>

          <td class="fw-semibold">
            {{ $bibit->kode_bibit }}
          </td>

          <td>
            {{ $bibit->nama_ikan }}
          </td>

          <td>
            {{ $bibit->tanggal_tebar ?? '-' }}
          </td>

          <td>
            {{ $bibit->jumlah_awal ?? 0 }}
          </td>

          <td>
            {{ $bibit->stok_sekarang ?? 0 }}
          </td>

          <td>
            @if ($bibit->status == 'tersedia')
            <span class="badge text-bg-success">Tersedia</span>
            @else
            <span class="badge text-bg-danger">Habis</span>
            @endif
          </td>

          <td class="text-end">
            <a href="{{ route('admin.bibit.edit', $bibit->id) }}"
              class="btn btn-light btn-sm">
              Edit
            </a>

            <button type="button"
              class="btn btn-danger btn-sm"
              data-bs-toggle="modal"
              data-bs-target="#hapusBibit{{ $bibit->id }}">
              Hapus
            </button>
          </td>
        </tr>

        {{-- Modal Hapus --}}
        <div class="modal fade"
          id="hapusBibit{{ $bibit->id }}"
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
                Yakin ingin menghapus bibit
                <strong>{{ $bibit->nama_ikan }}</strong>?
              </div>

              <div class="modal-footer">
                <button type="button"
                  class="btn btn-outline-secondary"
                  data-bs-dismiss="modal">
                  Batal
                </button>

                <form action="{{ route('admin.bibit.destroy', $bibit->id) }}"
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
          <td colspan="8" class="text-center text-muted">
            Belum ada data bibit.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</section>

@endsection