@extends('layouts.app')
@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">
  <div class="d-flex align-items-center gap-2">
    <button onclick="history.back()" class="btn btn-ghost"><i class="bi bi-arrow-left me-1"></i>Back</button>
    <h3 class="fw-bold mb-0"><i class="bi bi-list-task text-warning me-2"></i>Semua Progress — {{ $kegiatan->nama }}</h3>
  </div>
  <a href="{{ route('progress.create',$kegiatan) }}" class="btn btn-yy fw-semibold"><i class="bi bi-plus-circle me-1"></i>Tambah</a>
</div>

<div class="table-responsive rounded-3 overflow-hidden elev">
  <table class="table table-dark table-hover table-dark-custom align-middle mb-0">
    <thead>
      <tr><th>Judul</th><th>Status</th><th>Persen</th><th>Pembuat</th><th style="width:180px;">Aksi</th></tr>
    </thead>
    <tbody>
      @forelse($items as $p)
        <tr>
          <td class="fw-medium">{{ $p->judul }}</td>
          <td><span class="badge bg-secondary">{{ $p->status }}</span></td>
          <td>{{ $p->persen }}%</td>
          <td>{{ $p->user->name }}</td>
          <td>
            <div class="btn-group">
              @can('update',$p)
                <a href="{{ route('progress.edit',[$kegiatan,$p]) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i> Edit</a>
              @endcan
              @can('delete',$p)
                <form method="POST" action="{{ route('progress.destroy',[$kegiatan,$p]) }}" onsubmit="return confirm('Hapus progress?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i> Hapus</button>
                </form>
              @endcan
            </div>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="muted">Belum ada data.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-3">{{ $items->links() }}</div>
@endsection
