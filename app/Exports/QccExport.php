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
            'Kontes',
            'Nama QCC',
            'Juara SAI',
            'Juara PASI',
        ];
    }

    public function map($row): array
    {
        $juara_sai = ($row->juara_sai !== null && $row->juara_sai !== '0') ? (string) $row->juara_sai : '-';
        $juara_pasi = ($row->juara_pasi !== null && $row->juara_pasi !== '0') ? (string) $row->juara_pasi : '-';

        return [
            $row['nik'],
            $row['tema'],
            $row['kontes'],
            $row['nama_qcc'],
            $juara_sai,
            $juara_pasi,
        ];
    }
}
