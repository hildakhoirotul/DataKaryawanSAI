<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekapitulasi;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use App\Models\Ochi;
use App\Models\Qcc;

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
        $a = Absensi::where('nik', $user->nik)
        ->where('jenis', 'A')
        ->get();
        $s = Absensi::where('nik', $user->nik)
        ->where('jenis', 'S')
        ->get();
        $sd = Absensi::where('nik', $user->nik)
        ->where('jenis', 'SD')
        ->get();
        $iz = Absensi::where('nik', $user->nik)
        ->where('jenis', 'I')
        ->get();
        $itd = Absensi::where('nik', $user->nik)
        ->where('jenis', 'ITD')
        ->get();
        $icp = Absensi::where('nik', $user->nik)
        ->where('jenis', 'ICP')
        ->get();
        $td = Absensi::where('nik', $user->nik)
        ->where('jenis', 'TD')
        ->get();
        $cp = Absensi::where('nik', $user->nik)
        ->where('jenis', 'CP')
        ->get();
        $ochi = Ochi::where('nik', $user->nik)->get();
        $qcc = Qcc::where('nik', $user->nik)->get();
        $oleader = Ochi::where('nik_ochi_leader', $user->nik)->get();
        $jochi = Ochi::where('nik', $user->nik)
        ->whereIn('juara', ['juara 1', 'juara 2', 'juara 3'])
        ->get();
        $jqcc = Qcc::where('nik', $user->nik)
        ->whereIn('juara_sai', ['juara 1', 'juara 2', 'juara 3'])
        ->get();
        $rekap = Rekapitulasi::where('nik', $user->nik)->get();
        return response()->view('karyawan.index', compact('rekap', 'a', 's', 'sd', 'iz', 'itd', 'icp', 'td', 'cp', 'ochi', 'qcc', 'oleader', 'jochi', 'jqcc'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
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
}
