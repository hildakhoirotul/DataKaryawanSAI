<?php

namespace App\Exports;

use App\Models\Ochi;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OchiExport implements FromArray, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Ochi::all();
    // }
    protected $data;

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
            'NIK',
            'Tema',
            'NIK OCHI Leader',
            'Juara',
        ];
    }

    public function map($row): array
    {
        return [
            $row['nik'],
            $row['tema'],
            $row['nik_ochi_leader'],
            $row['juara'],
        ];
    }
}
