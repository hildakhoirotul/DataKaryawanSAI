<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Jobs\ImportData;
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
use App\Models\Setting;
use Exception;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\ValidationException;
use PhpParser\ErrorHandler\Collecting;
use DataTables;
use Illuminate\Support\Facades\View;

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
        $rekap = Rekapitulasi::get();
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return response()->view('admin.dashboard', compact('rekap', 'total', 'status'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    public function filterAbsensi(Request $request)
    {
        $jenisFilter = $request->query('jenis');
        $tanggalMulai = $request->query('tanggalMulai');
        $tanggalAkhir = $request->query('tanggalAkhir');

        // $absensiData = Absensi::where('jenis', 'like', '%' . $jenisFilter . '%')
        //     ->whereDate('tanggal', '>=', $tanggalMulai)
        //     ->whereDate('tanggal', '<=', $tanggalAkhir)
        //     ->get();
        $query = Absensi::query();

        if ($jenisFilter) {
            $query->where('jenis', $jenisFilter);
        }

        if ($tanggalMulai && $tanggalAkhir) {
            $query->whereDate('tanggal', '>=', $tanggalMulai)
                ->whereDate('tanggal', '<=', $tanggalAkhir);
        }

        $absensiData = $query->get();

        return view('admin.partial.absensi', ['absensiData' => $absensiData]);
    }

    public function filterOchi(Request $request)
    {
        $juaraFilter = $request->query('juara');

        $ochiData = Ochi::where('juara', 'like', '%' . $juaraFilter . '%')
            // ->whereDate('tanggal', '>=', $tanggalMulai)
            // ->whereDate('tanggal', '<=', $tanggalAkhir)
            ->get();
        // $query = Ochi::query();

        // if ($juaraFilter) {
        //     $query->where('juara', $juaraFilter);
        // }

        // $ochiData = $query->get();

        return view('admin.partial.ochi', ['ochiData' => $ochiData]);
    }

    public function filterQcc(Request $request)
    {
        $juaraFilter = $request->query('juara');

        $qccData = Qcc::where('juara_sai', 'like', '%' . $juaraFilter . '%')
            ->orwhere('juara_pasi', 'like', '%' . $juaraFilter . '%')
            // ->whereDate('tanggal', '<=', $tanggalAkhir)
            ->get();
        // $query = Ochi::query();

        // if ($juaraFilter) {
        //     $query->where('juara', $juaraFilter);
        // }

        // $ochiData = $query->get();

        return view('admin.partial.qcc', ['qccData' => $qccData]);
    }

    public function absensi(Request $request)
    {
        $total = Absensi::count();
        $absensi = Absensi::orderBy('tanggal', 'DESC')->get();
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return response()->view('admin.absensi', compact('absensi', 'total', 'status'));
    }

    public function ochi()
    {
        $total = Ochi::count();
        $ochi = Ochi::get();
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return response()->view('admin.ochi', compact('ochi', 'total', 'status'));
    }

    public function qcc()
    {
        $total = Qcc::count();
        $qcc = Qcc::get();
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        return response()->view('admin.qcc', compact('qcc', 'total', 'status'));
    }

    public function karyawan()
    {
        $total = User::count();
        $user = User::get();
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        // foreach ($user as $users) {
        //     $users->password = Crypt::decryptString($users->password);
        // }
        // $pass = User::select('password')->get();
        // $password = Crypt::decryptString($pass);
        return response()->view('admin.karyawan', compact('user', 'total', 'status'));
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

        $import = new RekapitulasiImport();
        Excel::import($import, $file);

        $errorMessages = [];
        $i = "1";
        foreach ($import->failures() as $failure) {
            $error = $failure->errors();
            $errorMessages[] = ($i++ . ". Terjadi kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        }
        if (!empty($errorMessages)) {
            $error = implode(" ", $errorMessages);
            Alert::html('Impor Gagal', 'Error pada: <br>' . $error)->width('725px');
            return redirect()->back();
        } else {
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->back();
        }

        Storage::delete($path);
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

        $import = new AbsensiImport();
        Excel::import($import, $file);

        $errorMessages = [];
        $i = "1";
        foreach ($import->failures() as $failure) {
            $error = $failure->errors();
            $errorMessages[] = ($i++ . ". Kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        }
        if (!empty($errorMessages)) {
            $error = implode(" ", $errorMessages);
            Alert::html('Impor Gagal', 'Error pada: <br>' . $error)->width('725px');
            return redirect()->back();
        } else {
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->back();
        }

        Storage::delete($path);
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

        $import = new OchiImport();
        Excel::import($import, $file);
        // $import = Excel::import(new OchiImport(), storage_path('app/public/excel/' . $nama_file));

        $errorMessages = [];
        $i = "1";
        foreach ($import->failures() as $failure) {
            $error = $failure->errors();
            $errorMessages[] = ($i++ . ". Terjadi kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        }
        if (!empty($errorMessages)) {
            $error = implode(" ", $errorMessages);
            Alert::html('Impor Gagal', 'Error pada: <br>' . $error)->width('725px');
            return redirect()->back();
        } else {
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->back();
        }
        Storage::delete($path);
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

        $import = new QccImport();
        Excel::import($import, $file);

        $errorMessages = [];
        $i = "1";
        foreach ($import->failures() as $failure) {
            $error = $failure->errors();
            $errorMessages[] = ($i++ . ". Terjadi kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        }
        if (!empty($errorMessages)) {
            $error = implode(" ", $errorMessages);
            Alert::html('Impor Gagal', 'Error pada: <br>' . $error)->width('725px');
            return redirect()->back();
        } else {
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->back();
        }

        Storage::delete($path);
    }

    public function importKaryawan(Request $request)
    {
        $file = $request->file('file');
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $nama_file = rand() . $file->getClientOriginalName();

        $path = $file->storeAs('public/excel/', $nama_file);

        $import = new UserImport();
        Excel::import($import, $file);

        $errorMessages = [];
        $i = "1";
        foreach ($import->failures() as $failure) {
            $error = $failure->errors();
            $errorMessages[] = ($i++ . ". Terjadi kesalahan pada baris " . $failure->row() . ', ' . implode(", ", $error) . "<br>");
        }
        if (!empty($errorMessages)) {
            $error = implode(" ", $errorMessages);
            Alert::html('Impor Gagal', 'Error pada: <br>' . $error)->width('725px');
            return redirect()->back();
        } else {
            Alert::success('Impor Berhasil', $nama_file . ' Berhasil diimpor');
            return redirect()->back();
        }

        Storage::delete($path);
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
        // $absensiData = Absensi::where('jenis', 'like', '%' . $jenisFilter)
        //     ->whereDate('tanggal', '>=', $tanggalMulai)
        //     ->whereDate('tanggal', '<=', $tanggalAkhir)
        //     ->get();

        // if($jenis) {
        // $query->where('jenis', $jenis);
        // }
        // $export = new AbsensiExport($data);
        // return Excel::download($export, 'absensi.xlsx');
        // $data = Absensi::all()->toArray();
        return Excel::download(new AbsensiExport($absensiData), 'absensi.xlsx');
    }

    public function exportOchi(Request $request)
    {
        $juaraFilter = $request->query('juara');
        $ochiData = Ochi::where('juara', 'like', '%' . $juaraFilter . '%')->get();

        // $data = Ochi::all()->toArray();
        return Excel::download(new OchiExport($ochiData), 'ochi.xlsx');
    }

    public function exportQcc(Request $request)
    {
        $juaraFilter = $request->query('juara');
        $qccData = Qcc::where('juara_sai', 'like', '%' . $juaraFilter . '%')
            ->orWhere('juara_pasi', 'like', '%' . $juaraFilter . '%')
            ->get();

        // $data = Qcc::all()->toArray();
        return Excel::download(new QccExport($qccData), 'qcc.xlsx');
    }

    public function settingLogin(Request $request)
    {
        $disable = $request->input('status');
        $setting = Setting::firstOrNew([]);
        $setting->login = $disable ? true : false;
        $setting->save();
        // dd($setting->login);
        if ($setting->login) {
            Alert::info('Perubahan disimpan', 'Beberapa fitur telah dinonaktifkan');
        } else {
            Alert::info('Perubahan disimpan', 'Beberapa fitur telah diaktifkan kembali');
        }
        return redirect()->route('/dashboard');
    }
}
