<?php

namespace App\Imports;

use App\Models\Qcc;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QccImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Qcc([
            'nik'     => $row['nik'],
            'tema'   => $row['tema'],
            'nama_qcc' => $row['nama_qcc'],
            'juara'  => $row['juara'],
        ]);
    }
}
