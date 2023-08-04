<?php

namespace App\Exports;

use App\Models\Ochi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OchiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Ochi::all();
    // }
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    // public function array(): array
    // {
    //     return $this->data;
    // }

    public function headings(): array
    {
        return [
            'NIK',
            'Tema',
            'Kontes',
            'NIK OCHI Leader',
            'Juara',
        ];
    }

    public function map($row): array
    {
        $juara = $row->juara !== '0' ? (string) $row->juara : '-';

        return [
            $row['nik'],
            $row['tema'],
            $row['kontes'],
            $row['nik_ochi_leader'],
            $juara,
        ];
    }
}
