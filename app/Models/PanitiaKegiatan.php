<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PanitiaKegiatan extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'panitia_kegiatan';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['user_id', 'kegiatan_id', 'jabatan', 'catatan'];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
