<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Throwable;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class UserImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithUpserts, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable, SkipsFailures;

    protected $errors = [];

    public function rules(): array
    {
        return [
            'nik' => 'required|min:6',
            'nama' => 'required',
            'password' => 'required',
        ];
    }

    public function model(array $row)
    {
        return new User([
            'nik'     => $row['nik'],
            'nama'    => $row['nama'],
            'email_verified_at' => now(),
            'chain'   => $row['password'],
            'password'   => Hash::make($row['password']),
            'verify_key' => Str::random(100),
        ]);
    }

    public function onError(Throwable $e)
    {
        $this->errors[] = $e->getMessage();
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function withValidation($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {
                $this->errors[] = $validator->errors()->all();
            }
        });
    }

    public function customValidationMessages(): array
    {
        return [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.min' => 'NIK harus terdiri dari 6 digit.',
            'nama.required' => 'Nama tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
        ];
    }

    public function uniqueBy()
    {
        return 'nik';
    }

    public function batchSize(): int
    {
        return 250;
    }

    public function chunkSize(): int
    {
        return 250; // Ubah sesuai dengan kebutuhan Anda
    }
}
