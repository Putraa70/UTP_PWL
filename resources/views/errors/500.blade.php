@extends('layouts.app')
@section('content')
<div class="text-center py-5">
  <div class="display-4 fw-black" style="color:var(--vivid-yellow)"><i class="bi bi-bug"></i> 500</div>
  <p class="muted">Terjadi kesalahan pada server.</p>
  <a href="{{ route('dashboard') }}" class="btn btn-yy fw-semibold mt-2"><i class="bi bi-arrow-counterclockwise me-1"></i>Coba lagi</a>
</div>
@endsection
