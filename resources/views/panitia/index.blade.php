@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <div><div class="muted small">Kegiatan</div><h3 class="fw-bold mb-0"><i class="bi bi-people text-warning me-2"></i>{{ $kegiatan->nama }}</h3></div>
  <a href="{{ route('kegiatan.panitia.create',$kegiatan) }}" class="btn btn-yy fw-semibold"><i class="bi bi-person-plus me-1"></i>Tambah Panitia</a>
</div>

<div class="table-responsive rounded-3 overflow-hidden elev">
  <table class="table table-dark table-hover table-dark-custom align-middle mb-0">
    <thead><tr><th>Nama</th><th>Jabatan</th><th>Catatan</th><th style="width:220px;">Aksi</th></tr></thead>
    <tbody>
      @forelse($panitia as $u)
        @php $p = $u->pivot; @endphp
        <tr>
          <td><div class="fw-medium">{{ $u->name }}</div><div class="muted small"><i class="bi bi-envelope me-1"></i>{{ $u->email }}</div></td>
          <td>{{ $p->jabatan ?? '—' }}</td>
          <td>{{ $p->catatan ?? '—' }}</td>
          <td>
            <div class="btn-group">
              <a href="{{ route('panitia.edit',$p->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil me-1"></i>Edit</a>
              <form method="POST" action="{{ route('panitia.destroy',$p->id) }}" onsubmit="return confirm('Hapus panitia ini?')">@csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3 me-1"></i>Hapus</button>
              </form>
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="4" class="muted">Belum ada panitia.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
