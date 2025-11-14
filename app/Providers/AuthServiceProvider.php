<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\PanitiaKegiatan;
use App\Policies\PanitiaKegiatanPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        PanitiaKegiatan::class => PanitiaKegiatanPolicy::class,
        \App\Models\KegiatanProgress::class => \App\Policies\KegiatanProgressPolicy::class,

    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('admin', fn($u) => $u->role === 'ADMIN');
        Gate::define('isPanitia', fn($u) => $u->role === 'PANITIA');
    }
}
