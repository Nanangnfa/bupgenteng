@extends('layouts.admin')

@section('title', 'Manajemen Akun')
@section('breadcrumb', 'Akun')
@section('page-title', 'Manajemen Akun')
@section('page-description', 'Monitoring dan pengelolaan akun pengguna sistem.')
@section('page-icon', 'bi bi-people')

@section('content')

<section class="panel">

  <div class="panel-header">
    <div>
      <h2 class="h5 mb-1 section-title">
        <span>Data Akun</span>
      </h2>
    </div>
  </div>

  @if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  @error('delete')
  <div class="alert alert-danger">
    {{ $message }}
  </div>
  @enderror

  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Tanggal Dibuat</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($users as $user)
        <tr>
          <td>{{ $loop->iteration }}</td>

          <td>
            <strong>{{ $user->name }}</strong>

            @if (auth()->id() === $user->id)
            <span class="badge text-bg-primary ms-2">Akun Saya</span>
            @endif
          </td>

          <td>{{ $user->email }}</td>

          <td>
            {{ $user->created_at ? $user->created_at->format('d-m-Y H:i') : '-' }}
          </td>

          <td class="text-end">
            @if (auth()->id() !== $user->id)
            <form action="{{ route('admin.users.destroy', $user->id) }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
              @csrf
              @method('DELETE')

              <button type="submit" class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i>
                Hapus
              </button>
            </form>
            @else
            <span class="text-muted small">Tidak bisa dihapus</span>
            @endif
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center text-muted">
            Belum ada akun terdaftar.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

</section>

@endsection