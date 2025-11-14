@extends('layouts.app')
@section('content')

{{-- Header ringkas --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
  <div>
    <h3 class="fw-bold mb-0">
      <i class="bi bi-speedometer2 me-2 text-warning"></i>Dashboard Admin
    </h3>
    <div class="muted">Kelola semua kegiatan & kepanitiaan.</div>
  </div>
  <div class="d-flex flex-column flex-sm-row gap-2">
    <a href="{{ route('kegiatan.create') }}" class="btn btn-yy fw-semibold">
      <i class="bi bi-plus-circle me-1"></i>Tambah Kegiatan
    </a>
    <a href="{{ route('kegiatan.index') }}" class="btn btn-ghost">
      <i class="bi bi-kanban me-1"></i>Lihat Kegiatan
    </a>
  </div>
</div>

{{-- Dua kartu utama (seperti awal, dipoles sedikit) --}}
<div class="row g-3 mb-3">
  <div class="col-md-6">
    <a class="text-decoration-none" href="{{ route('kegiatan.index') }}">
      <div class="card card-modern elev h-100">
        <div class="card-body d-flex align-items-start gap-3">
          <div class="display-6"><i class="bi bi-calendar2-event text-warning"></i></div>
          <div>
            <div class="fw-semibold">Kegiatan</div>
            <div class="muted small">Kelola event HIMAKOM, tanggal, lokasi, deskripsi & panitia.</div>
            {{-- kecil: info jumlah (opsional) --}}
            @php $totalKegiatan = $totalKegiatan ?? null; @endphp
            @if(!is_null($totalKegiatan))
              <div class="small mt-2">
                <span class="badge badge-yy">Total: {{ $totalKegiatan }}</span>
              </div>
            @endif
          </div>
        </div>
      </div>
    </a>
  </div>

  <div class="col-md-6">
    <div class="card card-modern elev h-100">
      <div class="card-body d-flex align-items-start gap-3">
        <div class="display-6"><i class="bi bi-people text-warning"></i></div>
        <div>
          <div class="fw-semibold">Admin: {{ auth()->user()->name }}</div>
          <div class="muted small">Gunakan menu untuk mengelola data.</div>
          <div class="d-flex flex-column flex-sm-row gap-2 mt-2">
            <a href="{{ route('kegiatan.index') }}" class="btn btn-sm btn-ghost">
              <i class="bi bi-people me-1"></i>Kelola Panitia
            </a>
            <a href="{{ route('kegiatan.index') }}" class="btn btn-sm btn-ghost">
              <i class="bi bi-graph-up-arrow me-1"></i>Progress
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Kegiatan terbaru (opsional, tampil jika ada $recentKegiatan atau $recent) --}}
@php
  $recent = $recentKegiatan ?? ($recent ?? collect());
@endphp
@if($recent->isNotEmpty())
  <div class="card card-modern elev">
    <div class="card-body">
      <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-2 mb-2">
        <div class="fw-semibold">
          <i class="bi bi-clock-history text-warning me-1"></i>Terbaru Dibuat
        </div>
        <a href="{{ route('kegiatan.index') }}" class="small text-decoration-none" style="color:#FFD60A">
          Lihat semua <i class="bi bi-arrow-right-short"></i>
        </a>
      </div>

      <div class="table-responsive rounded-3 overflow-hidden">
        <table class="table table-dark table-hover table-dark-custom align-middle mb-0">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Lokasi</th>
              <th style="width: 180px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($recent as $it)
              <tr>
                <td class="fw-medium">{{ $it->nama }}</td>
                <td>
                  <i class="bi bi-calendar-event me-1"></i>
                  {{ optional($it->tanggal_mulai)->format('d M Y') }} — {{ optional($it->tanggal_selesai)->format('d M Y') }}
                </td>
                <td>{{ $it->lokasi ?? '—' }}</td>
                <td>
                  <div class="btn-group flex-column flex-sm-row">
                    <a href="{{ route('kegiatan.show',$it) }}" class="btn btn-sm btn-ghost">
                      <i class="bi bi-eye me-1"></i>Detail
                    </a>
                    <a href="{{ route('kegiatan.edit',$it) }}" class="btn btn-sm btn-outline-warning">
                      <i class="bi bi-pencil-square me-1"></i>Edit
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@else
  {{-- Jika tidak ada recent, tampilkan tips kecil agar tetap terasa “hidup” --}}
  <div class="alert mt-2 border-0" style="background:#121212;border-radius:12px;color:#fff;">
    <i class="bi bi-info-circle me-1 text-warning"></i>
    Belum ada data terbaru. Buat kegiatan baru untuk mulai mengisi dashboard.
  </div>
@endif

@endsection
