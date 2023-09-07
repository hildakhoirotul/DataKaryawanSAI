<?php

namespace App\Exports;

use App\Models\Rekapitulasi;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RekapitulasiExport implements FromArray, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;

    // public function collection()
    // {
    //     return Rekapitulasi::all();
    // }

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'nik',
            'SD',
            'S',
            'I',
            'A',
            'ITD',
            'ICP',
            'TD',
            // 'CP',
            'OCHI',
            'QCC',
            'OCHI_leader',
            // 'Juara_OCHI',
            // 'Juara_QCC',
        ];
    }

    public function map($row): array
    {
        return [
            $row['nik'],
            $row['SD'],
            $row['S'],
            $row['I'],
            $row['A'],
            $row['ITD'],
            $row['ICP'],
            $row['TD'],
            // $row['CP'],
            $row['OCHI'],
            $row['QCC'],
            $row['OCHI_leader'],
            // $row['Juara_OCHI'],
            // $row['Juara_QCC'],
        ];
    }
}
