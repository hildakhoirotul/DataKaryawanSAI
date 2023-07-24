<?php

namespace App\Imports;

use App\Models\Rekapitulasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RekapitulasiImport implements ToModel, WithHeadingRow
{
    // WithHeadingRow
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Rekapitulasi([
            'nik'     => $row['nik'],
            'SD'      => $row['sd'],
            'S'       => $row['s'],
            'I'       => $row['i'],
            'A'       => $row['a'],
            'ITD'     => $row['itd'],
            'ICP'     => $row['cp'],
            'TD'      => $row['td'],
            'CP'      => $row['cp'],
            'OCHI'    => $row['ochi'],
            'QCC'     => $row['qcc'],
            'OCHI_leader' => $row['ochi_leader'],
            'Juara_OCHI' => $row['juara_ochi'],
            'Juara_QCC' => $row['juara_qcc'],
        ]);
    }
}
