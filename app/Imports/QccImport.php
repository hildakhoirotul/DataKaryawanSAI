<?php

namespace App\Imports;

use App\Models\Qcc;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Throwable;

class QccImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithBatchInserts
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
                // Rule::exists('users', 'nik'),
            ],
            'tema' => 'required',
            'nama_qcc' => 'required',
        ];
    }
    public function model(array $row)
    {
        return new Qcc([
            'nik'     => $row['nik'],
            'tema'   => $row['tema'],
            'kontes'   => $row['kontes'],
            'nama_qcc' => $row['nama_qcc'],
            'fasilitator_qcc' => $row['fasilitator_qcc'],
            'juara_sai'  => $row['juara_sai'],
            'juara_pasi'  => $row['juara_pasi'],
        ]);
    }

    public function batchSize(): int
    {
        return 500;
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
            // 'nik.exists' => 'NIK tidak valid',
            'tema.required' => 'Tema tidak boleh kosong.',
            'nama_qcc.required' => 'Nama QCC tidak boleh kosong.',
            // 'fasilitator_qcc.min' => 'NIK Fasilitator QCC harus terdiri dari 6 digit.',
        ];
    }
}
