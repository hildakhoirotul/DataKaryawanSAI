<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Alert;

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
        if (auth()->user()->password_changed==0) {
            Alert::warning('Ganti Password', 'Anda belum mengganti password, silahkan ganti terlebih dahulu!');
        //  Ganti "ganti.password" dengan route ke halaman ganti password
        }
        return response()->view('admin.dashboard')
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

    // public function showChangePassword()
    // {
    //     return response()->view('auth.change');
    // }

    // public function changePassword(Request $request)
    // {
    //     $request->validate([
    //         'nik' => 'required',
    //         'current_password' => 'required',
    //         'new_password' => 'required|string|min:6|confirmed',
    //     ]);

    //     $user = Auth::user();

    //     // Memeriksa apakah password lama sesuai
    //     if (!Hash::check($request->current_password, $user->password && $request->nik, $user->nik)) {
    //         return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
    //     }

    //     // Mengubah password baru
    //     $user->changePassword($request->new_password);

    //     return redirect()->route('login')->with('success', 'Password berhasil diubah.');
    // }
}
