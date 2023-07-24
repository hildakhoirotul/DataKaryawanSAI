<?php

namespace App\Imports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AbsensiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
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
}
