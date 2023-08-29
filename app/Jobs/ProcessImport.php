<?php

namespace App\Jobs;

use App\Imports\RekapitulasiImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ProcessImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $path;
    protected $nama_file;

    public function __construct($path, $nama_file)
    {
        $this->path = $path;
        $this->nama_file = $nama_file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $import = new RekapitulasiImport();
        Excel::import($import, $this->path);

        $errorMessages = [];
        $i = "1";
        foreach ($import->failures() as $failure) {
            $error = $failure->errors();
            $errorMessages[] = ($i++ . ". Kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        }
    
        if (!empty($errorMessages)) {
            $error = implode(" ", $errorMessages);
            Alert::html('<small>Impor Gagal</small>', '<small>Error pada: <br>' . $error, '</small>error')->width('600px');
            return redirect()->back();
        } else {
            Alert::success('Impor Berhasil', $this->nama_file . ' Berhasil diimpor');
            return redirect()->back();
        }

        Storage::delete($this->path);
    }
}
