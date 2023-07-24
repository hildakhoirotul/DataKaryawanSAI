<?php

namespace App\Imports;

use App\Models\Absensi;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class AbsensiImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use SkipsFailures, SkipsErrors;
    public function rules():array
    {
        return [
            'nik' => 'string|min:6',
            'tanggal' => 'string',
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

    public function onFailure(\Throwable $e)
    {
        $failures = $this->getSkippedRows();

        foreach ($failures as $failure) {
            $row = $failure->row();
            $errors = $failure->errors();
        }
    }
}
