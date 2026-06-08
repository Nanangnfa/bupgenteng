@extends('layouts.admin')

@section('title', 'Data Pemesanan')
@section('breadcrumb', 'Pemesanan')
@section('page-title', 'Data Pemesanan')
@section('page-description', 'Klik baris data untuk melihat detail pemesanan.')
@section('page-icon', 'bi bi-cart-check')

@section('content')

<section class="panel mt-3">

  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title">
        <span>Daftar Pemesanan</span>
      </h2>
    </div>

    <div class="d-flex gap-2">
      <input class="form-control form-control-sm table-search"
        type="search"
        placeholder="Cari pemesanan..."
        data-table-search="pemesananTable"
        aria-label="Cari pemesanan">
    </div>
  </div>

  <div class="table-responsive">
    <table class="table align-middle mb-0" id="pemesananTable" data-searchable-table>
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>Bibit</th>
          <th>Customer</th>
          <th>WhatsApp</th>
          <th>Jumla</th>
          <th>Status</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($pemesanans as $pemesanan)
        @php
        $wa = preg_replace('/[^0-9]/', '', $pemesanan->no_whatsapp);

        if (substr($wa, 0, 1) === '0') {
        $wa = '62' . substr($wa, 1);
        }
        @endphp

        <tr style="cursor: pointer;"
          data-bs-toggle="modal"
          data-bs-target="#detailPemesanan{{ $pemesanan->id }}">

          <td>{{ $loop->iteration }}</td>

          <td class="fw-semibold">
            {{ $pemesanan->kode_pemesanan }}
          </td>

          <td>
            {{ $pemesanan->bibit->kode_bibit ?? '-' }} -
            {{ $pemesanan->bibit->nama_ikan ?? '-' }}
          </td>

          <td>
            {{ $pemesanan->nama_customer }}
          </td>

          <td>
            {{ $pemesanan->no_whatsapp }}
          </td>

          <td>
            {{ $pemesanan->jumlah_pesan }}
          </td>

          <td>
            @if ($pemesanan->status == 'pending')
            <span class="badge text-bg-warning">Pending</span>
            @elseif ($pemesanan->status == 'disetujui')
            <span class="badge text-bg-success">Disetujui</span>
            @elseif ($pemesanan->status == 'ditolak')
            <span class="badge text-bg-danger">Ditolak</span>
            @else
            <span class="badge text-bg-primary">Selesai</span>
            @endif
          </td>

          <td class="text-end" onclick="event.stopPropagation();">
            <a href="{{ route('admin.pemesanan.edit', $pemesanan->id) }}"
              class="badge text-bg-primary w-100 mb-1">
              Status
            </a>

            <button type="button"
              class=" badge text-bg-danger w-100"
              data-bs-toggle="modal"
              data-bs-target="#hapusPemesanan{{ $pemesanan->id }}">
              Hapus
            </button>
          </td>
        </tr>

        {{-- Modal Detail --}}
        <div class="modal fade"
          id="detailPemesanan{{ $pemesanan->id }}"
          tabindex="-1"
          aria-hidden="true">

          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

              <div class="modal-header">
                <h2 class="modal-title h5">
                  Detail Pemesanan
                </h2>

                <button type="button"
                  class="btn-close"
                  data-bs-dismiss="modal">
                </button>
              </div>

              <div class="modal-body">
                <p>
                  <strong>Kode:</strong><br>
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

                <p class="mb-0">
                  <strong>Status:</strong><br>

                  @if ($pemesanan->status == 'pending')
                  <span class="badge text-bg-warning">Pending</span>
                  @elseif ($pemesanan->status == 'disetujui')
                  <span class="badge text-bg-success">Disetujui</span>
                  @elseif ($pemesanan->status == 'ditolak')
                  <span class="badge text-bg-danger">Ditolak</span>
                  @else
                  <span class="badge text-bg-primary">Selesai</span>
                  @endif
                </p>
              </div>

              <div class="modal-footer">
                <button type="button"
                  class="btn btn-outline-secondary"
                  data-bs-dismiss="modal">
                  Tutup
                </button>

                <a href="https://wa.me/{{ $wa }}"
                  target="_blank"
                  class="badge text-bg-success text-decoration-none p-2">
                  <i class="bi bi-whatsapp"></i>
                  Hubungi WhatsApp
                </a>
              </div>

            </div>
          </div>
        </div>

        {{-- Modal Hapus --}}
        <div class="modal fade"
          id="hapusPemesanan{{ $pemesanan->id }}"
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
                Yakin ingin menghapus pemesanan dari
                <strong>{{ $pemesanan->nama_customer }}</strong>?
              </div>

              <div class="modal-footer">
                <button type="button"
                  class="btn btn-outline-secondary"
                  data-bs-dismiss="modal">
                  Batal
                </button>

                <form action="{{ route('admin.pemesanan.destroy', $pemesanan->id) }}"
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
            Belum ada data pemesanan.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</section>

@endsection