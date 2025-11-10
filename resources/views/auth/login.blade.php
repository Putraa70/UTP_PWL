@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <div class="col-lg-5">
    <div class="mb-3">
      <h2 class="fw-bold mb-1">Masuk</h2>
      <div class="muted">Gunakan kredensial Admin/Panitia.</div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
      @csrf
      <div class="mb-3">
        <label class="form-label muted">Email</label>
        <div class="input-group">
          <span class="input-group-text input-dark"><i class="bi bi-at"></i></span>
          <input type="email" name="email" value="{{ old('email') }}" class="form-control input-dark" placeholder="nama@kampus.ac.id" required>
          <div class="invalid-feedback">Email wajib diisi.</div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label muted">Password</label>
        <div class="input-group">
          <span class="input-group-text input-dark"><i class="bi bi-lock"></i></span>
          <input type="password" name="password" class="form-control input-dark" placeholder="••••••••" required>
          <div class="invalid-feedback">Password wajib diisi.</div>
        </div>
      </div>
      <div class="d-grid gap-2">
        <button class="btn btn-yy fw-semibold"><i class="bi bi-box-arrow-in-right me-1"></i>Masuk</button>
      </div>
    </form>

    <div class="alert mt-3 border-0" style="background:#2a2207;color:#ffe88a;border-radius:12px;">
      <i class="bi bi-shield-lock me-1"></i> Akses dibatasi. Hubungi admin untuk pembuatan akun panitia.
    </div>
  </div>
</div>
@endsection
