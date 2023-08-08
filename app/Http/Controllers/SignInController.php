<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Alert;
use Illuminate\Http\JsonResponse;

class SignInController extends Controller
{
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where($this->username(), $request->input($this->username()))->first();
        $admin = $user->is_admin;
        if ($user) {
            if($admin == 1){
                session()->put('admin', $admin);
                return redirect()->route('login'); 
            }
            else {
                Auth::login($user);
                Alert::success('Berhasil Masuk', 'Selamat Datang ' . auth()->user()->nik);
                return redirect()->route('/home');
            }
        } else {
            Alert::error('Login Gagal', 'NIK anda tidak terdaftar')->persistent(true, false);
            return back();
        }
    }

    public function username()
    {
        return 'nik';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
        ]);
    }

}
