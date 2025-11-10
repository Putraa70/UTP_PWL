@extends('layouts.app')
@section('content')
<h3 class="fw-bold mb-3"><i class="bi bi-plus-circle text-warning me-2"></i>Tambah Progress — {{ $kegiatan->nama }}</h3>

<form method="POST" action="{{ route('progress.store',$kegiatan) }}" class="row g-3">
  @csrf
  <div class="col-md-6">
    <label class="form-label muted">Judul</label>
    <input name="judul" class="form-control input-dark" required value="{{ old('judul') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label muted">Status</label>
    <select name="status" class="form-select input-dark" required>
      @foreach(['PLANNED','ONGOING','BLOCKED','DONE'] as $st)
        <option value="{{ $st }}" @selected(old('status')===$st)>{{ $st }}</option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label muted">Persen</label>
    <input type="number" min="0" max="100" name="persen" class="form-control input-dark" value="{{ old('persen',0) }}" required>
  </div>

  <div class="col-12">
    <label class="form-label muted">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="form-control input-dark">{{ old('deskripsi') }}</textarea>
  </div>

  <div class="col-12 d-flex gap-2">
    <button class="btn btn-yy fw-semibold"><i class="bi bi-check2-circle me-1"></i>Simpan</button>
    <a href="{{ route('kegiatan.saya.show',$kegiatan) }}" class="btn btn-ghost">Batal</a>
  </div>
</form>
@endsection
