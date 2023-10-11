<?php

namespace App\Exports;

use App\Models\Rekapitulasi;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapitulasiExport implements FromArray, WithHeadings, WithMapping, WithStyles
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
            'OCHI',
            'QCC',
            'OCHI leader',
            'Fasilitator QCC',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function map($row): array
    {
        foreach ($row as $key => $value) {
            if ($value === '0') {
                $row[$key] = '-';
            }
        }
    
        return [
            $row['nik'],
            $row['SD'],
            $row['S'],
            $row['I'],
            $row['A'],
            $row['ITD'],
            $row['ICP'],
            $row['TD'],
            $row['OCHI'],
            $row['QCC'],
            $row['OCHI_leader'],
            $row['fasilitator_qcc'],
        ];
    }
}
