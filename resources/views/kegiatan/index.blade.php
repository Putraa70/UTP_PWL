@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="fw-bold mb-0"><i class="bi bi-calendar2-week text-warning me-2"></i>Kegiatan</h3>
  <a href="{{ route('kegiatan.create') }}" class="btn btn-yy fw-semibold"><i class="bi bi-plus-circle me-1"></i>Tambah</a>
</div>

<div class="table-responsive rounded-3 overflow-hidden elev">
  <table class="table table-dark table-hover table-dark-custom align-middle mb-0">
    <thead><tr><th>Nama</th><th>Tanggal</th><th>Lokasi</th><th style="width:240px;">Aksi</th></tr></thead>
    <tbody>
      @foreach($items as $it)
      <tr>
        <td class="fw-semibold">{{ $it->nama }}</td>
        <td><i class="bi bi-calendar-event me-1"></i>{{ $it->tanggal_mulai->format('d M Y') }} — {{ $it->tanggal_selesai->format('d M Y') }}</td>
        <td>{{ $it->lokasi ?? '—' }}</td>
        <td>
          <div class="btn-group">
            <a href="{{ route('kegiatan.show',$it) }}" class="btn btn-sm btn-ghost"><i class="bi bi-eye me-1"></i>Detail</a>
            <a href="{{ route('kegiatan.edit',$it) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square me-1"></i>Edit</a>
            <form method="POST" action="{{ route('kegiatan.destroy',$it) }}" class="d-inline" onsubmit="return confirm('Hapus kegiatan?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash me-1"></i>Hapus</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="mt-3">{{ $items->links() }}</div>
@endsection
