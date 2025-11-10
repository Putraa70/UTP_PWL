<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class KegiatanProgress extends Model
{
    use HasUuids;

    protected $table = 'kegiatan_progress';
    protected $fillable = [
        'kegiatan_id',
        'user_id',
        'judul',
        'deskripsi',
        'persen',
        'status',
        'lampiran_path'
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
