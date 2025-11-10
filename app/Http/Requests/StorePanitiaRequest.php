<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePanitiaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $kegiatanId = $this->route('kegiatan')->id;

        return [
            'user_id' => [
                'required',
                'uuid',
                'exists:users,id',
                // user tidak boleh dobel pada kegiatan yang sama
                Rule::unique('panitia_kegiatan', 'user_id')
                    ->where(fn($q) => $q->where('kegiatan_id', $kegiatanId)),
            ],
            'jabatan' => ['nullable', 'string', 'max:120'],
            'catatan' => ['nullable', 'string', 'max:500'], // plain text
        ];
    }
}
