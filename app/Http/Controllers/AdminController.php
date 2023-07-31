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
        // return view('admin.dashboard');
        // if (auth()->user()->password_changed == 0) {
        //     Alert::warning('Ganti Password', 'Anda belum mengganti password, silahkan ganti terlebih dahulu!');
        // }

        $rekap = Rekapitulasi::get();
        return response()->view('admin.dashboard', compact('rekap'))
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

        $qccData = Qcc::where('juara', 'like', '%' . $juaraFilter . '%')
            // ->whereDate('tanggal', '>=', $tanggalMulai)
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
        // if($request->ajax()) {
        //     $data = Absensi::select('*');
        //     return Datatables::of($data)
        //     ->addIndexColumn()
        //     ->filter(function ($instance) use ($request) {
        //         if ($request->get('jenis') == 'SD' || $request->get('jenis') == 'S') {
        //             $instance->where('jenis', $request->get('jenis'));
        //         }
        //     })
        //     ->rawColumns(['jenis'])
        //     ->make(true);
        // }
        // $jenisFilter = $request->query('jenis');
        // $absensi = Absensi::orderBy('tanggal', 'DESC')
        // ->where('jenis', 'like', '%' . $jenisFilter)->get();

        // if($request->ajax()) {
        //     return view('admin.absensi.export', ['absensi' => $absensi]);
        // }

        $absensi = Absensi::orderBy('tanggal', 'DESC')->get();
        return response()->view('admin.absensi', compact('absensi'));
    }

    public function ochi()
    {
        $ochi = Ochi::get();
        return response()->view('admin.ochi', compact('ochi'));
    }

    public function qcc()
    {
        $qcc = Qcc::get();
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
        $ochiData = Ochi::where('juara', 'like', '%' . $juaraFilter . '%')->get();

        // $data = Qcc::all()->toArray();
        return Excel::download(new QccExport($ochiData), 'qcc.xlsx');
    }
}
