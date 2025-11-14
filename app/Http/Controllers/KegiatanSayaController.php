<?php

namespace App\Http\Controllers;

use App\Models\{Kegiatan, KegiatanProgress};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class KegiatanSayaController extends Controller
{
    public function show(Request $request, Kegiatan $kegiatan)
    {
        $user = $request->user();

        // pastikan user adalah panitia kegiatan ini
        $kegiatan->load(['panitia' => fn($q) => $q->where('users.id', $user->id)]);
        abort_if($kegiatan->panitia->isEmpty(), 403);

        // agar $kegiatan->pivot bisa dipakai di view (jabatan/catatan)
        $pivot = $kegiatan->panitia->first()->pivot ?? null;
        if ($pivot) $kegiatan->setRelation('pivot', $pivot);

        // ambil progress kegiatan (kalau mau filter per user, tambahkan ->where('user_id',$user->id))
        $progress = $kegiatan->progress()->with('user')->latest()->paginate(6);

        $canCreateProgress = Gate::allows('create', [KegiatanProgress::class, $kegiatan]);

        return view('kegiatan.panitia_show', compact('kegiatan', 'progress', 'canCreateProgress'));
    }
}
