@extends('layouts.app')
@section('content')
<div class="text-center py-5">
  <div class="display-4 fw-black" style="color:var(--vivid-yellow)"><i class="bi bi-compass"></i> 404</div>
  <p class="muted">Halaman tidak ditemukan.</p>
  <a href="{{ route('dashboard') }}" class="btn btn-yy fw-semibold mt-2"><i class="bi bi-house-door me-1"></i>Kembali ke Dashboard</a>
</div>
@endsection
