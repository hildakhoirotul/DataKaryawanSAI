<?php

namespace App\Imports;

use App\Models\Rekapitulasi;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Throwable;

class RekapitulasiImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithBatchInserts
{
    // WithHeadingRow
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
        ];
    }

    public function model(array $row)
    {
        return new Rekapitulasi([
            'nik'     => $row['nik'],
            'SD'      => $row['sd'],
            'S'       => $row['s'],
            'I'       => $row['i'],
            'A'       => $row['a'],
            'ITD'     => $row['itd'],
            'ICP'     => $row['icp'],
            'TD'      => $row['td'],
            // 'CP'      => $row['cp'],
            'OCHI'    => $row['ochi'],
            'QCC'     => $row['qcc'],
            'OCHI_leader' => $row['ochi_leader'],
            'fasilitator_qcc' => $row['fasilitator_qcc'],
            // 'Juara_OCHI' => $row['juara_ochi'],
            // 'Juara_QCC' => $row['juara_qcc'],
        ]);
    }

    public function batchSize(): int
    {
        return 500;
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
            'nik.min' => 'NIK harus terdiri dari minimal 6 digit.',
        ];
    }

    public function onError(Throwable $e)
    {
        $this->errors[] = $e->getMessage();
    }
}
