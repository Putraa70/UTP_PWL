@extends('layouts.app')
@section('content')

<h3 class="fw-bold mb-3">
  <i class="bi bi-person-plus text-warning me-2"></i>
  Tambah Panitia — {{ $kegiatan->nama }}
</h3>

<form method="POST" action="{{ route('kegiatan.panitia.store',$kegiatan) }}" class="row g-3">
  @csrf

  <div class="col-12">
    <label class="form-label muted">User</label>
    <select name="user_id" class="form-select input-dark" required>
      <option value="">— pilih panitia —</option>
      @foreach($users as $u)
        <option value="{{ $u->id }}" @selected(old('user_id')==$u->id)>
          {{ $u->name }} — {{ $u->email }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label muted">Jabatan</label>
    <input name="jabatan" class="form-control input-dark" placeholder="Ketua Pelaksana / Sie Acara / ..." value="{{ old('jabatan') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label muted">Catatan (terenkripsi)</label>
    <input name="catatan" class="form-control input-dark" value="{{ old('catatan') }}">
  </div>

  <div class="col-12 d-flex gap-2">
    <button class="btn btn-yy fw-semibold">
      <i class="bi bi-check2-circle me-1"></i>Simpan
    </button>
    <a href="{{ route('kegiatan.panitia.index',$kegiatan) }}" class="btn btn-ghost">Batal</a>
  </div>
</form>

@endsection
