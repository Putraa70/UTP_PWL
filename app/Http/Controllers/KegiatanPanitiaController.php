<?php

namespace App\Http\Controllers;

use App\Models\{Kegiatan, PanitiaKegiatan, User};
use App\Http\Requests\{StorePanitiaRequest, UpdatePanitiaRequest};

class KegiatanPanitiaController extends Controller
{
    /** List panitia dalam kegiatan */
    public function index(Kegiatan $kegiatan)
    {
        // cukup ambil relasi; withPivot tak wajib karena sudah didefinisikan di relasi model
        $panitia = $kegiatan->panitia()->orderBy('name')->get();

        return view('panitia.index', compact('kegiatan', 'panitia'));
    }

    /** Form create */
    public function create(Kegiatan $kegiatan)
    {
        $users = User::orderBy('name')->get();
        return view('panitia.create', compact('kegiatan', 'users'));
    }

    /** Store: simpan PLAIN TEXT (tanpa encrypt/hash) */
    public function store(StorePanitiaRequest $r, Kegiatan $kegiatan)
    {
        try {
            PanitiaKegiatan::create([
                'kegiatan_id' => $kegiatan->id,
                'user_id'     => $r->validated()['user_id'],
                'jabatan'     => $r->validated()['jabatan'] ?? null,
                'catatan'     => $r->validated()['catatan'] ?? null, // <-- plain
            ]);

            return redirect()
                ->route('kegiatan.panitia.index', $kegiatan)
                ->with('ok', 'Panitia ditambahkan.');
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors('Gagal menambah panitia.')->withInput();
        }
    }

    /** Form edit */
    public function edit(PanitiaKegiatan $panitiaKegiatan)
    {
        $kegiatan = $panitiaKegiatan->kegiatan;
        $users    = User::orderBy('name')->get();

        return view('panitia.edit', compact('kegiatan', 'panitiaKegiatan', 'users'));
    }

    /** Update: kunci agar hanya field yang boleh yang diubah */
    public function update(UpdatePanitiaRequest $r, PanitiaKegiatan $panitiaKegiatan)
    {
        try {
            $data = $r->validated();

            $panitiaKegiatan->update([
                'user_id' => $data['user_id'],
                'jabatan' => $data['jabatan'] ?? null,
                'catatan' => $data['catatan'] ?? null, // <-- plain
            ]);

            return redirect()
                ->route('kegiatan.panitia.index', $panitiaKegiatan->kegiatan)
                ->with('ok', 'Panitia diperbarui.');
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors('Gagal memperbarui panitia.')->withInput();
        }
    }

    /** Destroy */
    public function destroy(PanitiaKegiatan $panitiaKegiatan)
    {
        try {
            $kegiatan = $panitiaKegiatan->kegiatan;
            $panitiaKegiatan->delete();

            return redirect()
                ->route('kegiatan.panitia.index', $kegiatan)
                ->with('ok', 'Panitia dihapus.');
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors('Gagal menghapus panitia.');
        }
    }
}
