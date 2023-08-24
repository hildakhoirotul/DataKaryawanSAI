<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showChangePassword()
    {
        return response()->view('auth.change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6'
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            Alert::error('Gagal', 'Password lama salah')->persistent(true, false);
            return redirect()->back();
        }

        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            Alert::error('Gagal', 'Password baru tidak boleh sama dengan Password lama')->persistent(true, false);
            return redirect()->back();
        }
        if (strcmp($request->get('new_password'), $request->get('password_confirmation')) !== 0) {
            Alert::error('Gagal', 'Password baru harus sama dengan Konfirmasi password')->persistent(true, false);
            return redirect()->back();
        }
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->chain = $request->get('new_password');
        $user->password_changed = true;
        $user->save();

        Alert::success('Password berhasil diubah', 'Silahkan Login kembali');
        return redirect()->route('login')->with('logout', true);
    }
}