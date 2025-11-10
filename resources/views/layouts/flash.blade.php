@if(session('ok'))
  <div class="alert alert-success border-0" style="background:#103b22;color:#b7f0c1;border-radius:14px;">
    <i class="bi bi-check2-circle me-2"></i>{{ session('ok') }}
  </div>
@endif

@if($errors->any())
  <div class="alert border-0" style="background:#3c1a1a;color:#ffd2d2;border-radius:14px;">
    <i class="bi bi-exclamation-triangle me-2"></i><strong>Terjadi kesalahan:</strong>
    <ul class="mb-0 mt-2">
      @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
  </div>
@endif
