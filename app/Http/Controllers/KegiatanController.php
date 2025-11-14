<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Http\Requests\StoreKegiatanRequest;
use App\Http\Requests\UpdateKegiatanRequest;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $items = Kegiatan::orderBy('tanggal_mulai', 'desc')->paginate(10);
        return view('kegiatan.index', compact('items'));
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(StoreKegiatanRequest $r)
    {
        try {
            Kegiatan::create($r->validated());
            return redirect()->route('kegiatan.index')->with('ok', 'Kegiatan dibuat.');
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors('Gagal menyimpan kegiatan.')->withInput();
        }
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load(['panitia' => fn($q) => $q->orderBy('name')]);
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(UpdateKegiatanRequest $r, Kegiatan $kegiatan)
    {
        try {
            $kegiatan->update($r->validated());
            return redirect()->route('kegiatan.index')->with('ok', 'Kegiatan diperbarui.');
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors('Gagal memperbarui kegiatan.')->withInput();
        }
    }

    public function destroy(Kegiatan $kegiatan)
    {
        try {
            $kegiatan->delete();
            return redirect()->route('kegiatan.index')->with('ok', 'Kegiatan dihapus.');
        } catch (\Throwable $e) {
            report($e);
            return back()->withErrors('Gagal menghapus kegiatan.');
        }
    }
}
