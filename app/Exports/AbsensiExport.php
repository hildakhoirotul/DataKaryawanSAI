<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
            'Jam Masuk',
            'Jam Pulang',
        ];
    }

    public function map($row): array
    {
        $jam_masuk = $row->jam_masuk !== '00:00:00' ? (string) $row->jam_masuk : '-';
        $jam_pulang = $row->jam_pulang !== '00:00:00' ? (string) $row->jam_pulang : '-';

        return [
            $row->nik,
            $row->jenis,
            $row->tanggal,
            $jam_masuk,
            $jam_pulang,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function registerEvents(): array
    {
        return [
            // Event BeforeSheet akan dipanggil sebelum data diekspor ke file Excel
            BeforeSheet::class => function (BeforeSheet $event) {
                // Set alignment to center for all cells
                $event->sheet->getDefaultStyle()
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
