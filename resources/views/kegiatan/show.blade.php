@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
  <div><h3 class="fw-bold mb-0"><i class="bi bi-journal-text text-warning me-2"></i>Detail Kegiatan</h3><div class="muted small">{{ $kegiatan->nama }}</div></div>
  @can('admin')
  <div class="btn-group">
    <a href="{{ route('kegiatan.edit',$kegiatan) }}" class="btn btn-ghost"><i class="bi bi-pencil-square me-1"></i>Edit</a>
    <a href="{{ route('kegiatan.panitia.index',$kegiatan) }}" class="btn btn-yy fw-semibold"><i class="bi bi-people me-1"></i>Kelola Panitia</a>
  </div>
  @endcan
</div>
<div class="row g-3">
  <div class="col-md-6">
    <div class="card card-modern h-100"><div class="card-body">
      <div class="mb-2 muted small">Nama Kegiatan</div><div class="fw-semibold fs-5">{{ $kegiatan->nama }}</div>
      <div class="row row-cols-2 mt-3 g-3">
        <div><div class="muted small">Mulai</div><div><i class="bi bi-calendar-event me-1"></i>{{ $kegiatan->tanggal_mulai->format('d M Y') }}</div></div>
        <div><div class="muted small">Selesai</div><div><i class="bi bi-calendar2-check me-1"></i>{{ $kegiatan->tanggal_selesai->format('d M Y') }}</div></div>
        <div class="col-12"><div class="muted small">Lokasi</div><div><i class="bi bi-geo-alt me-1"></i>{{ $kegiatan->lokasi ?? '—' }}</div></div>
      </div>
      <div class="mt-3"><div class="muted small mb-1">Deskripsi</div><p class="mb-0">{{ $kegiatan->deskripsi ?? '—' }}</p></div>
    </div></div>
  </div>
  <div class="col-md-6">
    <div class="card card-modern h-100"><div class="card-body">
      <div class="d-flex justify-content-between mb-2">
        <div class="fw-semibold"><i class="bi bi-people-fill text-warning me-1"></i>Panitia</div>
        @can('admin')<a href="{{ route('kegiatan.panitia.index',$kegiatan) }}" class="text-decoration-none muted small" style="color:#FFD60A"><i class="bi bi-gear-wide me-1"></i>Kelola</a>@endcan
      </div>
      <div class="vstack gap-2">
        @forelse($kegiatan->panitia as $u)
          <div class="p-2 rounded-3 d-flex justify-content-between align-items-center" style="background:#121212;border:1px solid #222;">
            <div><div class="fw-medium">{{ $u->name }}</div><div class="muted small"><i class="bi bi-envelope me-1"></i>{{ $u->email }}</div></div>
            <span class="badge badge-yy rounded-pill px-3 py-2 small">{{ $u->pivot->jabatan ?? 'Panitia' }}</span>
          </div>
        @empty
          <div class="muted">Belum ada panitia</div>
        @endforelse
      </div>
    </div></div>
  </div>
</div>
@endsection
