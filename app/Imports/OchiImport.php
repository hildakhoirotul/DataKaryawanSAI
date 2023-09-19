<?php

namespace App\Imports;

use App\Models\Ochi;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Throwable;

class OchiImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithBatchInserts
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
            'nik' => [
                'required',
                'min:6',
                Rule::exists('users', 'nik'),
            ],
            'tema' => 'required',
            'ochi_leader' => 'required|min:6',
        ];
    }

    public function model(array $row)
    {
        $juara = ($row['juara'] !== 0 && $row['juara'] !== null) ? $row['juara'] : '-';

        return new Ochi([
            'nik'     => $row['nik'],
            'tema'   => $row['tema'],
            'kontes'   => $row['kontes'],
            'nik_ochi_leader' => $row['ochi_leader'],
            'juara'  => $juara,
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
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
            'nik.exists' => 'NIK tidak valid',
            'tema.required' => 'Tema tidak boleh kosong.',
            'ochi_leader.required' => 'NIK OCHI leader tidak boleh kosong.',
            'ochi_leader.min' => 'NIK OCHI leader harus terdiri dari 6 digit.',
        ];
    }
}
