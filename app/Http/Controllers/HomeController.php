<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Alert;

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

        // $user = Auth::user();

        // // Memeriksa apakah password lama sesuai
        // if (!Hash::check($request->current_password, $user->password && $request->nik, $user->nik)) {
        //     return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        // }

        // // Mengubah password baru
        // $user->changePassword($request->new_password);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            Alert::error('Gagal', 'Password lama salah')->persistent(true, false);
            return redirect()->back();
        }

        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            Alert::error('Gagal', 'Password baru tidak boleh sama dengan Password lama')->persistent(true, false);
            return redirect()->back();
        }
        if (!(strcmp($request->get('new_password'), $request->get('password_confirmation'))) == 0) {
            //New password and confirm password are not same
            Alert::error('Gagal', 'Password baru harus sama dengan Konfirmasi password')->persistent(true, false);
            return redirect()->back();
        }
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->password_changed = true;
        $user->save();
        Auth::logout();

        Alert::success('Password berhasil diubah, Silahkan Login kembali');
        return redirect()->route('login');
    }
}
