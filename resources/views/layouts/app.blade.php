<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? 'HIMAKOM Manager' }}</title>

  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
  :root {
    --black:#000000;
    --black-soft:#0A0A0A;
    --yellow:#FFD60A;
    --white:#FFFFFF;
    --white-soft:#EDEDED;
    --border:#3A3A3A;
    --yellow-glow: rgba(255,214,10,.35);
  }

  html, body { height:100%; }

  body {
    background:
      radial-gradient(900px 500px at 20% -10%, rgba(255,214,10,.15), transparent 40%),
      radial-gradient(700px 450px at 100% 10%, rgba(255,214,10,.12), transparent 50%),
      var(--black);
    color: var(--white);
    font-family:"Plus Jakarta Sans", system-ui, sans-serif;
  }

  /* NAVBAR */
  .nav-blur {
    background:rgba(0,0,0,.75);
    backdrop-filter:blur(16px);
    border-bottom:1px solid var(--border);
  }
  .brand { color:var(--white);font-weight:700;text-decoration:none; }
  .brand .accent { color:var(--yellow); }

  /* CARD */
  .card-modern {
    background:linear-gradient(180deg,#0F0F0F,#010101);
    border:1px solid var(--border);
    border-radius:18px;
    color:var(--white);
    box-shadow:0 10px 28px rgba(0,0,0,.55);
  }

  /* TEXT */
  .muted { color:var(--white-soft) !important; }

  /* BUTTONS */
  .btn-yy{
    background:var(--yellow);
    color:#000;
    border:0;
    font-weight:600;
    padding:.45rem 1rem;
    border-radius:10px;
    transition:all .2s ease;
  }
  .btn-yy:hover{
    filter:brightness(.95);
    box-shadow:0 0 20px var(--yellow-glow);
  }

  .btn-ghost{
    background:#111;
    border:1px solid #444;
    color:var(--white);
    border-radius:10px;
  }
  .btn-ghost:hover{
    background:#1a1a1a;
    border-color:#666;
  }

  /* INPUT */
  .input-dark{
    background:#050505;
    border:1px solid #333;
    color:var(--white);
    border-radius:12px;
  }
  .input-dark::placeholder { color:#aaa; }
  .input-dark:focus{
    border-color:var(--yellow);
    box-shadow:0 0 0 .25rem var(--yellow-glow);
  }

  /* TABLE */
  .table-dark-custom{
    --bs-table-bg:#0C0C0C;
    --bs-table-color:var(--white);
    --bs-table-border-color:#2d2d2d;
    color:var(--white);
  }

  /* BADGE */
  .badge-yy{
    background:var(--yellow);
    color:#000;
    font-weight:600;
    border-radius:10px;
  }
</style>

</head>

<body>
<nav class="navbar navbar-expand-lg nav-blur sticky-top">
  <div class="container">
    <a class="brand" href="{{ route('dashboard') }}">HIMAKOM <span class="accent">Manager</span></a>
    <div class="ms-auto d-flex align-items-center gap-2">
      @auth
        <span class="d-none d-md-inline small muted me-1" style="color:white !important;">
          <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
        </span>
        <form method="POST" action="{{ route('logout') }}">@csrf
          <button class="btn btn-sm btn-ghost">
            <i class="bi bi-box-arrow-right me-1"></i>Logout
          </button>
        </form>
      @endauth
    </div>
  </div>
</nav>

<main class="container py-4">
  @include('layouts.flash')
  <div class="card card-modern elev">
    <div class="card-body p-4 p-md-5">
      {{ $slot ?? '' }}
      @yield('content')
    </div>
  </div>
</main>

<footer class="py-4 text-center small" style="color:white;">
  <i class="bi bi-stars me-1"></i>© HIMAKOM <span style="color:var(--vivid-yellow)">FMIPA UNILA</span>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
