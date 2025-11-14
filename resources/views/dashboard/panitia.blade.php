@extends('layouts.app')
@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">
  <h3 class="fw-bold mb-0"><i class="bi bi-list-task text-warning me-2"></i>Kegiatan Saya</h3>
</div>

@if($kegiatanSaya->isEmpty())
  <div class="alert border-0" style="background:#1e1e1e;color:#cfcfcf;border-radius:12px;">
    <i class="bi bi-info-circle me-1"></i> Belum ada penugasan panitia.
  </div>
@else
  <div class="row g-3">
    @foreach($kegiatanSaya as $k)
      <div class="col-md-6">
        <a href="{{ route('kegiatan.saya.show',$k) }}" class="text-decoration-none">
          <div class="card card-modern elev h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <div class="fw-semibold">{{ $k->nama }}</div>
                  <div class="muted small"><i class="bi bi-calendar-event me-1"></i>{{ $k->tanggal_mulai->format('d M Y') }} – {{ $k->tanggal_selesai->format('d M Y') }}</div>
                </div>
                <span class="badge badge-yy rounded-pill px-3 py-2 small">{{ $k->pivot->jabatan ?? 'Panitia' }}</span>
              </div>
              @if($k->lokasi)
                <div class="small mt-2 muted"><i class="bi bi-geo-alt me-1"></i> {{ $k->lokasi }}</div>
              @endif
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
@endif
@endsection
