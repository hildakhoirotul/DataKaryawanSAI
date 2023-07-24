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
use App\Imports\AbsensiImport;
use App\Imports\OchiImport;
use App\Imports\QccImport;
use App\Imports\RekapitulasiImport;
use App\Imports\UserImport;
use App\Models\Rekapitulasi;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

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
        foreach($user as $users) {
            $users->password = Crypt::decryptString($users->password);
        }
        // $pass = User::select('password')->get();
        // $password = Crypt::decryptString($pass);
        return response()->view('admin.karyawan', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        Rekapitulasi::truncate();
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

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

    public function importAbsensi(Request $request)
    {
        Absensi::truncate();
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = Excel::import(new AbsensiImport(), storage_path('app/public/excel/' . $nama_file));

        Storage::delete($path);

        if ($import) {
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->route('/absensi');
        } else {
            Alert::warning('Impor Gagal', $nama_file . ' Gagal diimpor');
            return redirect()->route('/absensi')->with(['error' => 'Data Gagal Diimport!']);
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
}
