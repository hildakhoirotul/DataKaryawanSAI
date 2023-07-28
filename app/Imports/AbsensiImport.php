<?php

namespace App\Imports;

use App\Models\Absensi;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Throwable;

class AbsensiImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
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
            'nik' => 'required|string|min:6',
            'jenis' => 'required|string',
            'tanggal' => 'required|string',
            // 'jam_masuk' => Rule::in(['date_format:YYYY-mm-dd']),
        ];
    }

    public function model(array $row)
    {
        // dd($row);
        return new Absensi([
            'nik'     => $row['nik'],
            'jenis'   => $row['jenis'],
            'tanggal' => $row['tanggal'],
            'jam_masuk'  => $row['jam_masuk'],
            'jam_pulang' => $row['jam_pulang'],
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
            'nik.string' => 'NIK harus berupa text.',
            'nik.min' => 'NIK harus terdiri dari minimal 6 digit.',
            'jenis.required' => 'Kolom Jenis tidak boleh kosong.',
            'jenis.string' => 'Jenis harus berupa text.',
            'tanggal.required' => 'Kolom Tanggal tidak boleh kosong.',
            'tanggal.string' => 'Tanggal harus berupa text.',
        ];
    }
}
