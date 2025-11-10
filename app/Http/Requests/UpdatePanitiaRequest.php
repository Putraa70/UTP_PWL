<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePanitiaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // kita butuh kegiatan_id dari baris panitia yang sedang diedit
        $panitia = $this->route('panitiaKegiatan');
        $kegiatanId = $panitia->kegiatan_id;

        return [
            'user_id' => [
                'required',
                'uuid',
                'exists:users,id',
                // unique kombinasi (kegiatan_id,user_id) tapi abaikan baris ini sendiri
                Rule::unique('panitia_kegiatan', 'user_id')
                    ->where(fn($q) => $q->where('kegiatan_id', $kegiatanId))
                    ->ignore($panitia->id, 'id'),
            ],
            'jabatan' => ['nullable', 'string', 'max:120'],
            'catatan' => ['nullable', 'string', 'max:500'], // plain text
        ];
    }
}
