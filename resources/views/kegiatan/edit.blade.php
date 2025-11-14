@extends('layouts.app')
@section('content')

<h3 class="fw-bold mb-4">
  <i class="bi bi-pencil-square text-warning me-2"></i>
  Edit Kegiatan
</h3>

<form method="POST" action="{{ route('kegiatan.update',$kegiatan) }}" class="row g-3">
  @csrf
  @method('PUT')

  <div class="col-md-6">
    <label class="form-label muted">Nama Kegiatan</label>
    <input type="text" name="nama" value="{{ old('nama',$kegiatan->nama) }}" class="form-control input-dark" required>
  </div>

  <div class="col-md-6">
    <label class="form-label muted">Lokasi</label>
    <input type="text" name="lokasi" value="{{ old('lokasi',$kegiatan->lokasi) }}" class="form-control input-dark">
  </div>

  <div class="col-md-6">
    <label class="form-label muted">Tanggal Mulai</label>
    <input type="date" 
           name="tanggal_mulai" 
           value="{{ old('tanggal_mulai',$kegiatan->tanggal_mulai->toDateString()) }}"
           class="form-control input-dark"
           required>
  </div>

  <div class="col-md-6">
    <label class="form-label muted">Tanggal Selesai</label>
    <input type="date"
           name="tanggal_selesai" 
           value="{{ old('tanggal_selesai',$kegiatan->tanggal_selesai->toDateString()) }}"
           class="form-control input-dark"
           required>
  </div>

  <div class="col-12">
    <label class="form-label muted">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="form-control input-dark">{{ old('deskripsi',$kegiatan->deskripsi) }}</textarea>
  </div>

  <div class="col-12 d-flex gap-2">
    <button class="btn btn-yy fw-semibold">
      <i class="bi bi-check2 me-1"></i>Update
    </button>

    <a href="{{ route('kegiatan.index') }}" class="btn btn-ghost">Batal</a>
  </div>
</form>

@endsection
