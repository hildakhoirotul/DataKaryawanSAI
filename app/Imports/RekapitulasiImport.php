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
        // dd($row);
        // return new Rekapitulasi([
        //     'nik'     => $row[0],
        //     'SD'      => $row[1],
        //     'S'       => $row[2],
        //     'I'       => $row[3],
        //     'A'       => $row[4],
        //     'ITD'     => $row[5],
        //     'ICP'     => $row[6],
        //     'TD'      => $row[7],
        //     'CP'      => $row[8],
        //     'OCHI'    => $row[9],
        //     'QCC'     => $row[10],
        //     'OCHI_leader' => $row[11],
        //     'Juara_OCHI' => $row[12],
        //     'Juara_QCC' => $row[13],
        // ]);
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
