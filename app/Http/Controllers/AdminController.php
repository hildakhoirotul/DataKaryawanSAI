<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Ochi;
use App\Models\Qcc;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\AbsensiExport;
use App\Exports\OchiExport;
use App\Exports\QccExport;
use App\Exports\RekapitulasiExport;
use App\Imports\AbsensiImport;
use App\Imports\OchiImport;
use App\Imports\QccImport;
use App\Imports\RekapitulasiImport;
use App\Imports\UserImport;
use App\Jobs\AbsensiImport as JobsAbsensiImport;
use App\Jobs\KaryawanImport;
use App\Jobs\OchiImport as JobsOchiImport;
use App\Jobs\ProcessImport;
use App\Jobs\QccImport as JobsQccImport;
use App\Models\Rekapitulasi;
use App\Models\Setting;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $total = Rekapitulasi::count();
        $rekap = Rekapitulasi::orderBy('nik', 'ASC')->paginate(50);
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return response()->view('admin.dashboard', compact('rekap', 'total', 'status'));
    }

    public function absensi(Request $request)
    {
        $total = Absensi::count();
        $absensi = Absensi::orderBy('tanggal', 'DESC')->paginate(100);
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return response()->view('admin.absensi', compact('absensi', 'total', 'status'));
    }

    public function ochi()
    {
        $total = Ochi::count();
        $ochi = Ochi::paginate(50);
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return response()->view('admin.ochi', compact('ochi', 'total', 'status'));
    }

    public function qcc()
    {
        $total = Qcc::count();
        $qcc = Qcc::paginate(50);
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return response()->view('admin.qcc', compact('qcc', 'total', 'status'));
    }

    public function karyawan(Request $request)
    {
        $state = false;
        $perPage = $request->input('paginate', 50);
        $user = User::paginate($perPage)->onEachSide(1);

        $total = User::count();
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return response()->view('admin.karyawan', compact('user', 'total', 'status', 'state', 'perPage'));
    }

    public function setting()
    {
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return view('admin.setting', compact('status'));
    }

    public function intruksi()
    {
        return view('admin.intruksi');
    }

    public function updateRekap()
    {
        $absensi = Absensi::all();
        $ochi = Ochi::all();
        $qcc = Qcc::all();
        $user = User::pluck('nik')->toArray();

        $total = [];
        foreach ($user as $nik) {
            $total[$nik] = [
                'SD' => 0,
                'S' => 0,
                'I' => 0,
                'A' => 0,
                'ITD' => 0,
                'ICP' => 0,
                'TD' => 0,
                'OCHI' => 0,
                'QCC' => 0,
                'OCHI_leader' => 0,
            ];
        }
        foreach ($absensi as $data) {
            $nik = $data->nik;
            $jenis = $data->jenis;

            if (!isset($total[$nik])) {
                $total[$nik] = [
                    'SD' => 0,
                    'S' => 0,
                    'I' => 0,
                    'A' => 0,
                    'ITD' => 0,
                    'ICP' => 0,
                    'TD' => 0,
                    'OCHI' => 0,
                    'QCC' => 0,
                    'OCHI_leader' => 0,
                ];
            }

            if ($jenis === 'SD') {
                $total[$nik]['SD']++;
            } elseif ($jenis === 'S') {
                $total[$nik]['S']++;
            } elseif ($jenis === 'I') {
                $total[$nik]['I']++;
            } elseif ($jenis === 'A') {
                $total[$nik]['A']++;
            } elseif ($jenis === 'ITD') {
                $total[$nik]['ITD']++;
            } elseif ($jenis === 'ICP') {
                $total[$nik]['ICP']++;
            } else {
                $total[$nik]['TD']++;
            }
        }

        foreach ($ochi as $oc) {
            $nik = $oc->nik;
            $ochi_leader = $oc->nik_ochi_leader;

            if (!isset($total[$nik])) {
                $total[$nik] = [
                    'SD' => 0,
                    'S' => 0,
                    'I' => 0,
                    'A' => 0,
                    'ITD' => 0,
                    'ICP' => 0,
                    'TD' => 0,
                    'OCHI' => 0,
                    'QCC' => 0,
                    'OCHI_leader' => 0,
                ];
            }
            $total[$nik]['OCHI']++;

            if (!isset($total[$ochi_leader])) {
                $total[$ochi_leader] = [
                    'SD' => 0,
                    'S' => 0,
                    'I' => 0,
                    'A' => 0,
                    'ITD' => 0,
                    'ICP' => 0,
                    'TD' => 0,
                    'OCHI' => 0,
                    'QCC' => 0,
                    'OCHI_leader' => 0,
                ];
            }

            $total[$ochi_leader]['OCHI_leader']++;
        }

        foreach ($qcc as $qc) {
            $nik = $qc->nik;

            if (!isset($total[$nik])) {
                $total[$nik] = [
                    'SD' => 0,
                    'S' => 0,
                    'I' => 0,
                    'A' => 0,
                    'ITD' => 0,
                    'ICP' => 0,
                    'TD' => 0,
                    'OCHI' => 0,
                    'QCC' => 0,
                    'OCHI_leader' => 0,
                ];
            }
            $total[$nik]['QCC']++;
        }

        foreach ($total as $nik => $totalData) {
            Rekapitulasi::updateOrCreate(['nik' => $nik], $totalData);
        }

        return redirect()->back();
    }

    public function searchRekap(Request $request)
    {
        $searchTerm = $request->input('nik');

        $query = Rekapitulasi::query();

        if ($searchTerm) {
            $query->where('nik', 'LIKE', '%' . $searchTerm . '%');
        }
        // $results = Rekapitulasi::where('nik', 'LIKE', '%' . $searchTerm . '%')
        //     ->paginate(100);

        $results = $query->paginate(50);
        return view('admin.partial.rekap', ['results' => $results]);
    }

    public function filterAbsensi(Request $request)
    {
        $jenisFilter = $request->query('jenis');
        $tanggalMulai = $request->query('tanggalMulai');
        $tanggalAkhir = $request->query('tanggalAkhir');
        $searchTerm = $request->input('nik');

        $query = Absensi::query();

        if ($jenisFilter) {
            $query->where('jenis', $jenisFilter);
        }

        if ($tanggalMulai && $tanggalAkhir) {
            $query->whereDate('tanggal', '>=', $tanggalMulai)
                ->whereDate('tanggal', '<=', $tanggalAkhir);
        }

        if ($searchTerm) {
            $query->where('nik', 'LIKE', '%' . $searchTerm . '%');
        }

        $absensiData = $query->orderBy('tanggal', 'DESC')->get();

        return view('admin.partial.absensi', ['absensiData' => $absensiData]);
    }

    public function filterOchi(Request $request)
    {
        $juaraFilter = $request->query('juara');
        $searchTerm = $request->input('search');

        $query = Ochi::query();

        if ($juaraFilter) {
            $query->where('juara', 'like', '%' . $juaraFilter . '%');
        }

        // if ($searchTerm) {
        //     $query->where('nik', 'ILIKE', '%' . $searchTerm . '%')
        //         ->orWhere('tema', 'ILIKE', '%' . $searchTerm . '%')
        //         ->orWhere('kontes', 'ILIKE', '%' . $searchTerm . '%')
        //         ->orWhere('nik_ochi_leader', 'ILIKE', '%' . $searchTerm . '%');
        // }

        if ($searchTerm) {
            $query->where('nik', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('tema', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('kontes', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('nik_ochi_leader', 'LIKE', '%' . $searchTerm . '%');
        }

        $ochiData = $query->get();

        // $ochiData = Ochi::where('juara', 'like', '%' . $juaraFilter . '%')
        //     ->get();
        return view('admin.partial.ochi', ['ochiData' => $ochiData]);
    }

    public function filterQcc(Request $request)
    {
        $juaraFilter = $request->query('juara');
        $searchTerm = $request->input('search');

        $query = Qcc::query();

        if ($juaraFilter) {
            $query->where('juara_sai', 'like', '%' . $juaraFilter . '%');
        }

        // if ($searchTerm) {
        //     $query->where('nik', 'ILIKE', '%' . $searchTerm . '%')
        //         ->orWhere('tema', 'ILIKE', '%' . $searchTerm . '%')
        //         ->orWhere('kontes', 'ILIKE', '%' . $searchTerm . '%')
        //         ->orWhere('nama_qcc', 'ILIKE', '%' . $searchTerm . '%')
        //         ->orWhere('juara_sai', 'ILIKE', '%' . $searchTerm . '%')
        //         ->orWhere('juara_pasi', 'ILIKE', '%' . $searchTerm . '%');
        // }

        if ($searchTerm) {
            $query->where('nik', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('tema', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('kontes', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('nama_qcc', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('juara_sai', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('juara_pasi', 'LIKE', '%' . $searchTerm . '%');
        }

        $qccData = $query->get();

        return view('admin.partial.qcc', ['qccData' => $qccData]);
    }

    public function searchKaryawan(Request $request)
    {
        $searchTerm = $request->input('nik');

        $query = User::query();

        if ($searchTerm) {
            $query->where('nik', 'LIKE', '%' . $searchTerm . '%');
        }
        // $results = Rekapitulasi::where('nik', 'LIKE', '%' . $searchTerm . '%')
        //     ->paginate(100);

        $user = $query->paginate(100);
        return view('admin.partial.karyawan', ['user' => $user]);
    }

    public function showForm()
    {
        return view('import');
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $nama_file = rand() . $file->getClientOriginalName();
        Rekapitulasi::truncate();

        $path = $file->storeAs('public/excel/', $nama_file);

        ProcessImport::dispatch($path)->onQueue('impor_rekap');
        return redirect()->back();
        // $import = new RekapitulasiImport();
        // Excel::import($import, $file);

        // $errorMessages = [];
        // $i = "1";
        // foreach ($import->failures() as $failure) {
        //     $error = $failure->errors();
        //     $errorMessages[] = ($i++ . ". Kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        // }

        // if (!empty($errorMessages)) {
        //     $error = implode(" ", $errorMessages);
        //     Alert::html('<small>Impor Gagal</small>', '<small>Error pada: <br>' . $error, '</small>error')->width('600px');
        //     return redirect()->back();
        // } else {
        //     Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
        //     return redirect()->back();
        // }

        // Storage::delete($path);
    }

    public function importAbsensi(Request $request)
    {
        $file = $request->file('file');
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $nama_file = rand() . $file->getClientOriginalName();
        Absensi::truncate();

        $path = $file->storeAs('public/excel/', $nama_file);

        JobsAbsensiImport::dispatch($path)->onQueue('impor_absensi');

        // $import = new AbsensiImport();
        // Excel::import($import, $file);

        // $errorMessages = [];
        // $i = "1";
        // foreach ($import->failures() as $failure) {
        //     $error = $failure->errors();
        //     $errorMessages[] = ($i++ . ". Kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        // }
        // if (!empty($errorMessages)) {
        //     $error = implode(" ", $errorMessages);
        //     Alert::html('<small>Impor Gagal</small>', '<small>Error pada: <br>' . $error, '</small> error')->width('575px');
        //     return redirect()->back();
        // } else {
        //     Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
        //     return redirect()->back();
        // }

        // Storage::delete($path);
        return redirect()->back();
    }

    public function importOchi(Request $request)
    {
        $file = $request->file('file');
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $nama_file = rand() . $file->getClientOriginalName();
        Ochi::truncate();

        $path = $file->storeAs('public/excel/', $nama_file);

        JobsOchiImport::dispatch($path)->onQueue('impor_ochi');

        // $import = new OchiImport();
        // Excel::import($import, $file);

        // $errorMessages = [];
        // $i = "1";
        // foreach ($import->failures() as $failure) {
        //     $error = $failure->errors();
        //     $errorMessages[] = ($i++ . ". Kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        // }
        // if (!empty($errorMessages)) {
        //     $error = implode(" ", $errorMessages);
        //     Alert::html('<small>Impor Gagal</small>', '<small>Error pada: <br>' . $error, '</small>error')->width('600px');
        //     return redirect()->back();
        // } else {
        //     Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
        //     return redirect()->back();
        // }
        // Storage::delete($path);
        return redirect()->back();
    }

    public function importQcc(Request $request)
    {
        $file = $request->file('file');
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $nama_file = rand() . $file->getClientOriginalName();
        Qcc::truncate();

        $path = $file->storeAs('public/excel/', $nama_file);

        JobsQccImport::dispatch($path)->onQueue('impor_qcc');

        // $import = new QccImport();
        // Excel::import($import, $file);

        // $errorMessages = [];
        // $i = "1";
        // foreach ($import->failures() as $failure) {
        //     $error = $failure->errors();
        //     $errorMessages[] = ($i++ . ". Kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        // }
        // if (!empty($errorMessages)) {
        //     $error = implode(" ", $errorMessages);
        //     Alert::html('<small>Impor Gagal</small>', '<small>Error pada: <br>' . $error, '</small>error')->width('600px');
        //     return redirect()->back();
        // } else {
        //     Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
        //     return redirect()->back();
        // }

        // Storage::delete($path);
        return redirect()->back();
    }

    public function importKaryawan(Request $request)
    {
        $file = $request->file('file');
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        set_time_limit(0);
        KaryawanImport::dispatch($path)->onQueue('impor_rekap');
        return redirect()->back();

        // $import = new UserImport();
        // Excel::import($import, $file);

        // $errorMessages = [];
        // $i = "1";
        // foreach ($import->failures() as $failure) {
        //     $error = $failure->errors();
        //     $errorMessages[] = ($i++ . ". Kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        // }
        // if (!empty($errorMessages)) {
        //     $error = implode(" ", $errorMessages);
        //     Alert::html('<small>Impor Gagal</small>', '<small>Error pada: <br>' . $error, '</small>error')->width('600px');
        //     return redirect()->back();
        // } else {
        //     Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
        //     return redirect()->back();
        // }

        // Storage::delete($path);
    }

    public function exportExcel()
    {
        $data = Rekapitulasi::all()->toArray();
        return Excel::download(new RekapitulasiExport($data), 'rekapitulasi.xlsx');
    }

    public function exportAbsensi(Request $request)
    {
        $jenisFilter = $request->query('jenis');
        $tanggalMulai = $request->query('tanggalMulai');
        $tanggalAkhir = $request->query('tanggalAkhir');

        $query = Absensi::query();

        if ($jenisFilter) {
            $query->where('jenis', $jenisFilter);
        }

        if ($tanggalMulai && $tanggalAkhir) {
            $query->whereDate('tanggal', '>=', $tanggalMulai)
                ->whereDate('tanggal', '<=', $tanggalAkhir);
        }

        $absensiData = $query->get();
        return Excel::download(new AbsensiExport($absensiData), 'absensi.xlsx');
    }

    public function exportOchi(Request $request)
    {
        $juaraFilter = $request->query('juara');
        $ochiData = Ochi::where('juara', 'like', '%' . $juaraFilter . '%')->get();

        return Excel::download(new OchiExport($ochiData), 'ochi.xlsx');
    }

    public function exportQcc(Request $request)
    {
        $juaraFilter = $request->query('juara');
        $qccData = Qcc::where('juara_sai', 'like', '%' . $juaraFilter . '%')
            ->get();

        return Excel::download(new QccExport($qccData), 'qcc.xlsx');
    }

    public function settingLogin(Request $request)
    {
        $disable = $request->input('status');
        $setting = Setting::firstOrNew([]);
        $setting->login = $disable ? true : false;
        $setting->save();
        if ($setting->login) {
            Alert::html('<small>Perubahan disimpan</small>', '<small>Beberapa fitur telah dinonaktifkan</small>', 'info');
        } else {
            Alert::html('<small>Perubahan disimpan</small>', '<small>Beberapa fitur telah diaktifkan kembali</small>', 'info');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }

    public function unduh($nama_file)
    {
        $path = storage_path('app/public/Download/' . $nama_file);

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            abort(404);
        }
    }

    public function remove(Request $request)
    {
        $ids = $request->input('ids');
        User::whereIn('id', $ids)->delete();
        return redirect()->back();
    }
}
