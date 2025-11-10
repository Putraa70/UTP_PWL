<?php

namespace App\Http\Controllers;

use App\Models\{Kegiatan, KegiatanProgress};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class KegiatanProgressController extends Controller
{
    public function index(Kegiatan $kegiatan)
    {
        $items = $kegiatan->progress()->with('user')->latest()->paginate(10);
        return view('progress.index', compact('kegiatan', 'items'));
    }

    public function create(Kegiatan $kegiatan)
    {
        abort_unless(Gate::allows('create', [KegiatanProgress::class, $kegiatan]), 403);
        return view('progress.create', compact('kegiatan'));
    }

    public function store(Request $r, Kegiatan $kegiatan)
    {
        abort_unless(Gate::allows('create', [KegiatanProgress::class, $kegiatan]), 403);

        $data = $r->validate([
            'judul' => ['required', 'string', 'max:120'],
            'deskripsi' => ['nullable', 'string'],
            'persen' => ['required', 'integer', 'min:0', 'max:100'],
            'status' => ['required', Rule::in(['PLANNED', 'ONGOING', 'BLOCKED', 'DONE'])],
        ]);

        $data['kegiatan_id'] = $kegiatan->id;
        $data['user_id'] = $r->user()->id;

        KegiatanProgress::create($data);
        return redirect()->route('progress.index', $kegiatan)->with('ok', 'Progres ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan, KegiatanProgress $progress)
    {
        $this->authorize('update', $progress);
        return view('progress.edit', compact('kegiatan', 'progress'));
    }

    public function update(Request $r, Kegiatan $kegiatan, KegiatanProgress $progress)
    {
        $this->authorize('update', $progress);

        $data = $r->validate([
            'judul' => ['required', 'string', 'max:120'],
            'deskripsi' => ['nullable', 'string'],
            'persen' => ['required', 'integer', 'min:0', 'max:100'],
            'status' => ['required', Rule::in(['PLANNED', 'ONGOING', 'BLOCKED', 'DONE'])],
        ]);

        $progress->update($data);
        return redirect()->route('progress.index', $kegiatan)->with('ok', 'Progres diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan, KegiatanProgress $progress)
    {
        $this->authorize('delete', $progress);
        $progress->delete();
        return back()->with('ok', 'Progres dihapus.');
    }
}
