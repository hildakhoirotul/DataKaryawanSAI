<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Absensi::all();
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
            'nik',
            'Jenis',
            'Tanggal',
            'Jam_masuk',
            'Jam_pulang',
        ];
    }

    public function map($row): array
    {
        return [
            $row->nik,
            $row->jenis,
            $row->tanggal,
            $row->jam_masuk,
            $row->jam_pulang,
            // $row['nik'],
            // $row['jenis'],
            // $row['tanggal'],
            // $row['jam_masuk'],
            // $row['jam_pulang'],
        ];
    }
}
