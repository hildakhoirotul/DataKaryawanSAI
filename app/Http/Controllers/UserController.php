<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekapitulasi;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use App\Models\Ochi;
use App\Models\Qcc;
use App\Models\Setting;
use App\Models\Information;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $a = Cache::remember('absensi_a_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Absensi::where('nik', $user->nik)->where('jenis', 'A')->get();
        });
        $s = Cache::remember('absensi_s_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Absensi::where('nik', $user->nik)->where('jenis', 'S')->get();
        });
        $sd = Cache::remember('absensi_sd_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Absensi::where('nik', $user->nik)->where('jenis', 'SD')->get();
        });
        $iz = Cache::remember('absensi_iz_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Absensi::where('nik', $user->nik)->where('jenis', 'I')->get();
        });
        $itd = Cache::remember('absensi_itd_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Absensi::where('nik', $user->nik)->where('jenis', 'ITD')->get();
        });
        $icp = Cache::remember('absensi_icp_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Absensi::where('nik', $user->nik)->where('jenis', 'ICP')->get();
        });
        $td = Cache::remember('absensi_td_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Absensi::where('nik', $user->nik)->where('jenis', 'TD')->get();
        });
        // $cp = Cache::remember('absensi_cp_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
        //     return Absensi::where('nik', $user->nik)->where('jenis', 'CP')->get();
        // });
        $ochi = Cache::remember('ochi_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Ochi::where('nik', $user->nik)->get();
        });
    
        $qcc = Cache::remember('qcc_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Qcc::where('nik', $user->nik)->get();
        });
        $oleader = Cache::remember('oleader_' . $user->nik, Carbon::now()->addMinutes(5), function () use ($user) {
            return Ochi::where('nik_ochi_leader', $user->nik)->get();
        });
        // $a = Absensi::where('nik', $user->nik)
        //     ->where('jenis', 'A')
        //     ->get();
        // $s = Absensi::where('nik', $user->nik)
        //     ->where('jenis', 'S')
        //     ->get();
        // $sd = Absensi::where('nik', $user->nik)
        //     ->where('jenis', 'SD')
        //     ->get();
        // $iz = Absensi::where('nik', $user->nik)
        //     ->where('jenis', 'I')
        //     ->get();
        // $itd = Absensi::where('nik', $user->nik)
        //     ->where('jenis', 'ITD')
        //     ->get();
        // $icp = Absensi::where('nik', $user->nik)
        //     ->where('jenis', 'ICP')
        //     ->get();
        // $td = Absensi::where('nik', $user->nik)
        //     ->where('jenis', 'TD')
        //     ->get();
        // $cp = Absensi::where('nik', $user->nik)
        //     ->where('jenis', 'CP')
        //     ->get();
        // $ochi = Ochi::where('nik', $user->nik)->get();
        // $qcc = Qcc::where('nik', $user->nik)->get();
        // $oleader = Ochi::where('nik_ochi_leader', $user->nik)->get();
        // $jochi = Ochi::where('nik', $user->nik)
        //     ->whereIn('juara', ['Juara 1', 'Juara 2', 'Juara 3'])
        //     ->get();
        // $jqcc = Qcc::where('nik', $user->nik)
        //     ->whereIn('juara_sai', ['Juara 1', 'Juara 2', 'Juara 3'])
        //     ->get();
        $rekap = Rekapitulasi::where('nik', $user->nik)->get();
        $setting = Setting::firstOrNew([]);
        $status = $setting->login;
        $info = Information::get();
        set_time_limit(0);
        // dd($itd);
        return response()->view('karyawan.home', compact('rekap', 'a', 's', 'sd', 'iz', 'itd', 'icp', 'td', 'ochi', 'qcc', 'oleader','status', 'info'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }
}
