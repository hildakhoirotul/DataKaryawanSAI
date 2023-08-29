<?php

namespace App\Imports;

use App\Models\Rekapitulasi;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Throwable;
use App\Events\ImportFinished;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\WithEvents;
use RealRashid\SweetAlert\Facades\Alert;

class RekapitulasiImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithChunkReading, WithEvents
{
    // WithHeadingRow
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable, SkipsFailures;

    protected $errors = [];

    public function rules(): array
    {
        return [
            'nik' => 'required|min:6',
        ];
    }

    public function model(array $row)
    {
        return new Rekapitulasi([
            'nik'     => $row['nik'],
            'SD'      => $row['sd'],
            'S'       => $row['s'],
            'I'       => $row['i'],
            'A'       => $row['a'],
            'ITD'     => $row['itd'],
            'ICP'     => $row['icp'],
            'TD'      => $row['td'],
            'CP'      => $row['cp'],
            'OCHI'    => $row['ochi'],
            'QCC'     => $row['qcc'],
            'OCHI_leader' => $row['ochi_leader'],
            'Juara_OCHI' => $row['juara_ochi'],
            'Juara_QCC' => $row['juara_qcc'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function withValidation($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {
                $this->errors[] = $validator->errors()->all();
            }
        });
    }

    public function customValidationMessages(): array
    {
        return [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.min' => 'NIK harus terdiri dari minimal 6 digit.',
        ];
    }

    public function onError(Throwable $e)
    {
        $this->errors[] = $e->getMessage();
    }

    public function registerEvents(): array
    {
        return [
            ImportFinished::class => function (ImportFinished $event) {
                $import = $event->getConcernable();

                $errorMessages = [];
                foreach ($import->failures() as $failure) {
                    $error = $failure->errors();
                    $errorMessages[] = "Kesalahan pada baris " . $failure->row() . ': ' . implode(", ", $error);
                }

                if (!empty($errorMessages)) {
                    $error = implode(" ", $errorMessages);
                    Alert::html('<small>Impor Gagal</small>', '<small>Error pada: <br>' . $error, '</small>error')->width('600px');
                    return redirect()->back();
                } else {
                    Alert::success('Impor Berhasil', ' Berhasil diimpor');
                    return redirect()->back();
                }
            },
        ];
    }
}
