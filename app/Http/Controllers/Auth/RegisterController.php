<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MailSend;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function register(Request $request)
    {
        $messages = [
            'nik.min' => 'NIK harus memiliki minimal :min karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password harus memiliki minimal :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok dengan password.',
        ];

        $validator = Validator::make($request->all(), [
            'nik' => 'min:6|unique:users',
            'email' => 'email|max:255|unique:users',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'same:password',
        ], $messages);

        $validationErrors = [];

        if ($validator->fails()) {
            $validationErrors = $validator->errors()->all();
            Alert::html('Gagal Mendaftar', implode(" <br> ", $validationErrors), 'error')->width('600px');
            return redirect()->route('register');
        }

        $str = Str::random(100);
        User::create([
            'nik' => $request->nik,
            'email' => $request->email,
            'chain' => $request->password,
            'password' => Hash::make($request->password),
            'verify_key' => $str,
        ]);

        $details = [
            'nik' => $request->nik,
            'website' => 'http://127.0.0.1:8000/',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];

        // Mail::to($request->email)->send(new MailSend($details));

        try {
            Mail::to($request->email)->send(new MailSend($details));
            Alert::success('Link Verifikasi telah dikirim', 'Silahkan periksa email anda untuk verifikasi email.');
            return view('auth.login');
        } catch (\Exception $e) {
            Alert::error('Gagal dikirim', 'Pastikan email anda telah benar');
            return redirect()->back();
        }
        // Alert::success('Link Verifikasi telah dikirim', 'Silahkan periksa email anda untuk verifikasi email.');
        // return view('auth.login');
    }

    public function verify($verify_key)
    {
        $user = User::where('verify_key', $verify_key)->first();

        if ($user) {
            $user->email_verified_at = now();
            $user->save();
            return "Verifikasi link berhasil, silahkan login";
        } else {
            return "Key tidak valid!";
        }
    }
}
