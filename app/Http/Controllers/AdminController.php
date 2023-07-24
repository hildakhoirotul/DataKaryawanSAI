<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Ochi;
use App\Models\Qcc;
use Alert;
use App\Exports\AbsensiExport;
use App\Exports\OchiExport;
use App\Exports\QccExport;
use App\Exports\RekapitulasiExport;
use App\Imports\AbsensiImport;
use App\Imports\OchiImport;
use App\Imports\QccImport;
use App\Imports\RekapitulasiImport;
use App\Imports\UserImport;
use App\Models\Rekapitulasi;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\ValidationException;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // return view('admin.dashboard');
        // if (auth()->user()->password_changed == 0) {
        //     Alert::warning('Ganti Password', 'Anda belum mengganti password, silahkan ganti terlebih dahulu!');
        // }

        $rekap = Rekapitulasi::latest()->paginate(10);
        return response()->view('admin.dashboard', compact('rekap'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    public function absensi()
    {
        $absensi = Absensi::latest()->paginate(10);
        return response()->view('admin.absensi', compact('absensi'));
    }

    public function ochi()
    {
        $ochi = Ochi::latest()->paginate(10);
        return response()->view('admin.ochi', compact('ochi'));
    }

    public function qcc()
    {
        $qcc = Qcc::latest()->paginate(10);
        return response()->view('admin.qcc', compact('qcc'));
    }

    public function karyawan()
    {
        $user = User::latest()->paginate(5);
        foreach ($user as $users) {
            $users->password = Crypt::decryptString($users->password);
        }
        // $pass = User::select('password')->get();
        // $password = Crypt::decryptString($pass);
        return response()->view('admin.karyawan', compact('user'));
    }

    public function showForm()
    {
        return view('import');
    }

    public function importExcel(Request $request)
    {
        // $file = $request->file('file');

        // Excel::import(new RekapitulasiImport, $file);

        // return redirect()->back()->with('success', 'Data berhasil diimpor.');

        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();
        Rekapitulasi::truncate();

        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new RekapitulasiImport(), storage_path('app/public/excel/' . $nama_file));

        // $data = Excel::toArray(new RekapitulasiImport(), storage_path('app/public/excel/' . $nama_file));

        // foreach ($data as $row) {
        //     $uniqueColumn = ['id'];

        //     $dataToInsert = [
        //         'nik' => $row['nik'],
        //         'SD' => $row['SD'],
        //         'S' => $row['S'],
        //         'I' => $row['I'],
        //         'A' => $row['A'],
        //         'ITD' => $row['ITD'],
        //         'ICP' => $row['ICP'],
        //         'TD' => $row['TD'],
        //         'CP' => $row['CP'],
        //         'OCHI' => $row['OCHI'],
        //         'QCC' => $row['QCC'],
        //         'OCHI_leader' => $row['OCHI_leader'],
        //         'Juara_OCHI' => $row['Juara_OCHI'],
        //         'Juara_QCC' => $row['Juara_QCC'],
        //     ];

        //     Rekapitulasi::updateOrInsert($uniqueColumn, $dataToInsert);
        // }
        Storage::delete($path);

        if ($import) {
            //redirect
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->route('/dashboard');
        } else {
            //redirect
            Alert::warning('Impor Gagal', $nama_file . ' Gagal diimpor');
            return redirect()->route('/dashboard')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    public function handleError(ValidationException $e)
    {
        $failures = $e->failures();
        $errorMessages = [];
        foreach ($failures as $failure) {
            $error = $failure->errors();
            $errorMessages[] = 'Terjadi kesalahan pada baris ' . $failure->row() . ', ' . implode(', ', $error);
        }
        return $errorMessages;
    }

    public function importAbsensi(Request $request)
    {
        try {
            $file = $request->file('file');
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx'
            ]);
            $nama_file = rand() . $file->getClientOriginalName();
            Absensi::truncate();

            $path = $file->storeAs('public/excel/', $nama_file);

            $import = new AbsensiImport();
            Excel::import($import, $file);

            Storage::delete($path);

            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->back();
        } catch (ValidationException $e) {
            $errorMessages = $this->handleError($e);
            Alert::warning('Impor Gagal', 'eror pada: ' . implode(', ', $errorMessages));
            return redirect()->back();
        }
    }

    public function importOchi(Request $request)
    {
        Ochi::truncate();
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new OchiImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        if ($import) {
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->route('/data-ochi');
        } else {
            Alert::warning('Impor Gagal', $nama_file . ' Gagal diimpor');
            return redirect()->route('/data-ochi')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    public function importQcc(Request $request)
    {
        Qcc::truncate();
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new QccImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        if ($import) {
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->route('/data-qcc');
        } else {
            Alert::warning('Impor Gagal', $nama_file . ' Gagal diimpor');
            return redirect()->route('/data-qcc')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    public function importKaryawan(Request $request)
    {
        // User::truncate();
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new UserImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        if ($import) {
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->route('/karyawan');
        } else {
            Alert::warning('Impor Gagal', $nama_file . ' Gagal diimpor');
            return redirect()->route('/karyawan')->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    public function exportExcel()
    {
        $data = Rekapitulasi::all()->toArray();
        return Excel::download(new RekapitulasiExport($data), 'rekapitulasi.xlsx');
    }

    public function exportAbsensi()
    {
        $data = Absensi::all()->toArray();
        return Excel::download(new AbsensiExport($data), 'absensi.xlsx');
    }

    public function exportOchi()
    {
        $data = Ochi::all()->toArray();
        return Excel::download(new OchiExport($data), 'ochi.xlsx');
    }

    public function exportQcc()
    {
        $data = Qcc::all()->toArray();
        return Excel::download(new QccExport($data), 'qcc.xlsx');
    }
}
