@extends('layouts.app')
@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">
  <div class="d-flex align-items-center gap-2">
    <button onclick="history.back()" class="btn btn-ghost"><i class="bi bi-arrow-left me-1"></i>Back</button>
    <div>
      <h3 class="fw-bold mb-0"><i class="bi bi-calendar2-heart text-warning me-2"></i>Detail Progja</h3>
      <div class="muted small">{{ $kegiatan->nama }}</div>
    </div>
  </div>
  <span class="badge badge-yy rounded-pill px-3 py-2">
    {{ optional($kegiatan->pivot)->jabatan ?? 'Panitia' }}
  </span>
</div>

<div class="row g-3">
  {{-- Info Kegiatan --}}
  <div class="col-md-6">
    <div class="card card-modern h-100">
      <div class="card-body">
        <div class="mb-2 muted small">Rentang Waktu</div>
        <div>
          <i class="bi bi-calendar-event me-1"></i>
          {{ $kegiatan->tanggal_mulai->format('d M Y') }} — {{ $kegiatan->tanggal_selesai->format('d M Y') }}
        </div>
        @if($kegiatan->lokasi)
          <div class="mt-2"><i class="bi bi-geo-alt me-1"></i>{{ $kegiatan->lokasi }}</div>
        @endif

        <div class="mt-3">
          <div class="muted small mb-1">Deskripsi</div>
          <p class="mb-0">{{ $kegiatan->deskripsi ?? '—' }}</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Progress --}}
  <div class="col-md-6">
    <div class="card card-modern h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div class="fw-semibold"><i class="bi bi-graph-up-arrow me-1 text-warning"></i>Progress Kegiatan</div>
          <div class="btn-group">
            <a href="{{ route('progress.index',$kegiatan) }}" class="btn btn-sm btn-ghost">
              <i class="bi bi-list-task me-1"></i>Semua
            </a>
            @if($canCreateProgress)
              <a href="{{ route('progress.create',$kegiatan) }}" class="btn btn-sm btn-yy fw-semibold">
                <i class="bi bi-plus-circle me-1"></i>Tambah
              </a>
            @endif
          </div>
        </div>

        @if($progress->isEmpty())
          <div class="muted">Belum ada progress.</div>
        @else
          <div class="vstack gap-2">
            @foreach($progress as $p)
              <div class="p-2 rounded-3" style="background:#121212;border:1px solid #222;">
                <div class="d-flex justify-content-between gap-3">
                  <div>
                    <div class="fw-semibold">{{ $p->judul }}</div>
                    <div class="muted small">{{ $p->deskripsi ?: '—' }}</div>
                    <div class="small mt-1">
                      <span class="badge bg-secondary">{{ $p->status }}</span>
                      <span class="ms-2"><i class="bi bi-percent"></i> {{ $p->persen }}%</span>
                      <span class="ms-2 muted"><i class="bi bi-person-circle me-1"></i>{{ $p->user->name }}</span>
                    </div>
                  </div>
                  <div class="btn-group">
                    @can('update',$p)
                      <a href="{{ route('progress.edit',[$kegiatan,$p]) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                    @endcan
                    @can('delete',$p)
                      <form method="POST" action="{{ route('progress.destroy',[$kegiatan,$p]) }}"
                            onsubmit="return confirm('Hapus progress ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                      </form>
                    @endcan
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <div class="mt-3">
            {{ $progress->links() }}
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
{{-- List Panitia --}}
<div class="row g-3 mt-2">
  <div class="col-12">
    <div class="card card-modern">
      <div class="card-body">

        <h5 class="fw-semibold mb-3">
          <i class="bi bi-people text-warning me-1"></i>
          Panitia Kegiatan Ini
        </h5>

        @php
          // ambil semua panitia kegiatan BESERTA pivot jabatan/catatan
          $semuaPanitia = $kegiatan->panitia()->withPivot(['jabatan','catatan'])->get();
        @endphp

        @if($semuaPanitia->isEmpty())
          <div class="muted">Belum ada panitia terdaftar.</div>

        @else
          <div class="table-responsive rounded-3 overflow-hidden elev">
            <table class="table table-dark table-hover table-dark-custom align-middle mb-0">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Catatan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($semuaPanitia as $u)
                  <tr>
                    <td class="fw-medium">{{ $u->name }}</td>
                    <td>{{ $u->pivot->jabatan ?? '—' }}</td>
                    <td>{{ $u->pivot->catatan ?? '—' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif

      </div>
    </div>
  </div>
</div>

@endsection
