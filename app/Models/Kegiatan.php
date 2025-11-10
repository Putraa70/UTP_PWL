<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kegiatan extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'deskripsi'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function panitia()
    {
        return $this->belongsToMany(User::class, 'panitia_kegiatan')
            ->withPivot(['id', 'jabatan', 'catatan'])
            ->withTimestamps();
    }
    // app/Models/Kegiatan.php
    public function progress()
    {
        return $this->hasMany(KegiatanProgress::class);
    }
}
