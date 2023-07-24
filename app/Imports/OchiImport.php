<?php

namespace App\Imports;

use App\Models\Ochi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OchiImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Ochi([
            'nik'     => $row['nik'],
            'tema'   => $row['tema'],
            'nik_ochi_leader' => $row['ochi_leader'],
            'juara'  => $row['juara'],
        ]);
    }
}
