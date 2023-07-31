<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $user;
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function username()
    {
        return 'nik';
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        // $user = User::where($this->username(), $credentials[$this->username()])->first();
        // if ($user && Crypt::decryptString($user->password) === $credentials['password']) {
        //     if ($user->is_admin == 1) {
        //         Auth::login($user);
        //         if ($user->password_changed == 0) {
        //             Alert::warning('Ganti Password', 'Anda belum mengganti password, silahkan ganti terlebih dahulu!');
        //         } else {
        //             Alert::success('Berhasil Masuk, Selamat Datang ' . auth()->user()->nik);
        //         }
        //         return redirect()->route('/dashboard');
        //     } else {
        //         // Auth::login($user);
        //         if ($user->password_changed == 0) {
        //             Alert::warning('Ganti Password', 'Anda belum mengganti password, silahkan ganti terlebih dahulu!');
        //         } else {
        //             Alert::success('Berhasil Masuk, Selamat Datang ' . auth()->user()->nik);
        //         }
        //         return redirect()->route('/home');
        //     }
        // } else {
        //     Alert::error('Login Gagal', 'NIK atau kata sandi salah!')->persistent(true, false);
        //     return back();
        // }
        if (Auth::attempt($credentials)) {
            if (auth()->user()->is_admin == 1) {
                if (auth()->user()->password_changed == 0) {
                    Alert::warning('Ganti Password', 'Anda belum mengganti password, silahkan ganti terlebih dahulu!');
                } else {
                    Alert::success('Berhasil Masuk', 'Selamat Datang ' . auth()->user()->nik);
                }
                return redirect()->route('/dashboard');
            } else {
                if (auth()->user()->password_changed == 0) {
                    Alert::warning('Ganti Password', 'Anda belum mengganti password, silahkan ganti terlebih dahulu!');
                } else {
                    Alert::success('Berhasil Masuk', 'Selamat Datang ' . auth()->user()->nik);
                }
                return redirect()->route('/home');
            }
        } else {

            Alert::error('Login Gagal', 'NIK atau kata sandi salah!')->persistent(true, false);
            return back();
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }
}
