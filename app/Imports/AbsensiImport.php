<?php

namespace App\Imports;

use App\Models\Absensi;
use App\Models\User;
use App\Rules\ValidDate;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Throwable;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class AbsensiImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithBatchInserts
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
            'jenis' => 'required|max:3',
            'tanggal' => ['required', new ValidDate()],
        ];
    }

    public function model(array $row)
    {
        $date = intval($row['tanggal']);
        $timeIn = floatval($row['jam_masuk']);
        $timeOut = floatval($row['jam_pulang']);
        $error = [];

        return new Absensi([
            'nik'     => $row['nik'],
            'jenis'   => $row['jenis'],
            'tanggal' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y-m-d'),
            'jam_masuk'  => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($timeIn),
            'jam_pulang' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($timeOut),
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
            'jenis.required' => 'Jenis tidak boleh kosong.',
            'jenis.max' => 'Jenis melebihi 3 karakter',
            'tanggal.required' => 'Tanggal tidak boleh kosong.',
        ];
    }
}
