<?php

namespace App\Exports;

use App\Models\Qcc;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QccExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Qcc::all();
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
            'Nama QCC',
            'Juara',
        ];
    }

    public function map($row): array
    {
        return [
            $row['nik'],
            $row['tema'],
            $row['nama_qcc'],
            $row['juara'],
        ];
    }
}
