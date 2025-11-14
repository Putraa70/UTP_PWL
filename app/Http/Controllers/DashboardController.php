<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kegiatan;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        // =============================
        // DASHBOARD ADMIN
        // =============================
        if ($user->role === 'ADMIN') {

            $totalKegiatan   = Kegiatan::count();
            $recentKegiatan  = Kegiatan::latest('created_at')->limit(5)->get();

            return view('dashboard.admin', compact(
                'totalKegiatan',
                'recentKegiatan'
            ));
        }

        // =============================
        // DASHBOARD PANITIA
        // =============================
        $kegiatanSaya = $user->kegiatans()
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        return view('dashboard.panitia', compact('kegiatanSaya'));
    }
}
