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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Throwable;
use App\Events\ImportFinished;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class RekapitulasiImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
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

    // public function chunkSize(): int
    // {
    //     return 1000;
    // }

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


    // public function finished(ImportFinished $event)
    // {
    //     $import = $event->getConcernable();
    //     $errorMessages = [];
    //     foreach ($import->failures() as $failure) {
    //         $error = $failure->errors();
    //         $errorMessages[] = "Kesalahan pada baris " . $failure->row() . ': ' . implode(", ", $error);
    //     }

    //     if (!empty($errorMessages)) {
    //         $error = implode("<br>", $errorMessages);
    //         Alert::html('<small>Impor Gagal</small>', '<small>' . $error . '</small>', 'error')->width('600px');
    //     } else {
    //         $nama_file = '';
    //         Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
    //     }

    //     $path = '';
    //     Storage::delete($path);
    // }
}
