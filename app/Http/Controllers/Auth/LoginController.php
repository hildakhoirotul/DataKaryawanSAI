<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Mail\MyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
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

    public function showLoginForm()
    {
        $remember = session()->get('remember');
        $user = auth()->user();
        if(!empty($remember)){
            if ($user->is_admin == 1) {
                if (auth()->user()->password_changed == 0) {
                    Alert::warning('Ganti Password', 'Anda belum mengganti password, silahkan ganti terlebih dahulu!');
                } else {
                    Alert::success('Berhasil Masuk', 'Selamat Datang ' . auth()->user()->nik);
                }
                return redirect()->route('dashboard');
            } else {
                if (auth()->user()->password_changed == 0) {
                    Alert::warning('Ganti Password', 'Anda belum mengganti password, silahkan ganti terlebih dahulu!');
                } else {
                    Alert::success('Berhasil Masuk', 'Selamat Datang ' . auth()->user()->nik);
                }
                return redirect()->route('home');
            }
        } else {
            Auth::logout();
            return view('auth.login');
        }
    }

    public function username()
    {
        return 'nik';
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
        $user = User::where('nik', $request->nik)->first();
        $remember = $request->has('remember') ? true : false; 
        Session::put('user', $user);
        Session::put('remember', $remember);
        if (!$user) {
            Alert::error('NIK tidak terdaftar', 'Pastikan NIK yang Anda masukkan sudah benar.');
            return redirect()->back()->withInput();
        } elseif ($user->email_verified_at === null) {
            Alert::error('Belum terverifikasi', 'Silahkan lakukan verifikasi link terlebih dahulu');
            return redirect()->back()->withInput();
        } else {
            if (Auth::attempt($credentials, $remember)) {
                if (auth()->user()->is_admin == 1) {
                    if (auth()->user()->password_changed == 0) {
                        Alert::warning('Ganti Password', 'Anda dapat mengganti password di halaman Ganti Sandi');
                    } else {
                        Alert::success('Berhasil Masuk', 'Selamat Datang ' . auth()->user()->nik);
                    }
                    return redirect()->route('dashboard');
                } else {
                    if (auth()->user()->password_changed == 0) {
                        Alert::warning('Ganti Password', 'Anda dapat mengganti password di halaman Ganti Sandi');
                    } else {
                        Alert::success('Berhasil Masuk', 'Selamat Datang ' . auth()->user()->nama);
                    }
                    return redirect()->route('home');
                }
            } else {
                Alert::error('Login Gagal', 'NIK atau kata sandi salah!')->persistent(true, false);
                return back();
            }
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
            : redirect('/');
    }

    public function ForgetPassword()
    {
        return view('auth.send');
    }

    public function GetEmail(Request $request)
    {
        $email = $request->input('email');
        $nik = $request->input('nik');
        $pass = $request->input('password');
        $user = User::where('nik', $nik)
        ->where('initial_pass', $pass)
        ->first();

        if(!$user){
            Alert::error('Gagal', 'NIK atau Password awal anda tidak sesuai. Password awal merupakan gabungan nik dan tanggal lahir anda');
            return redirect()->route('lupa-password');
        }
        try {
        Mail::to($email)->send(new MyMail($email, $user));

        Alert::success('Berhasil Dikirim', 'Silahkan Cek Email Anda dan Login kembali');
        return redirect('/login');
        } catch (\Exception $e) {
            Alert::error('Gagal dikirim', 'Pastikan nik dan email anda telah benar');
            return redirect()->back();
        }
    }
}
