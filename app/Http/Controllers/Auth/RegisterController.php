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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nik' => ['required', 'string', 'min:6'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required|same:password',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     $user = User::create([
    //         'nik' => $data['nik'],
    //         'email' => $data['email'],
    //         'chain'=>$data['password'],
    //         'password' => Hash::make($data['password']),
    //     ]);

    //     dd($user);

    //     if($user){
    //         Alert::success('Berhasil Mendaftar', 'Silahkan masuk terlebih dahulu');
    //         return redirect()->route('/'); 
    //     } else {
    //         Alert::error('Gagal', 'Silahkan mencoba kembali');
    //         return redirect()->back(); 
    //     }
    // }

    protected function register(Request $request)
    {
        $str = Str::random(100);
        User::create([
            'nik' => $request->nik,
            'email' => $request->email,
            'chain' => $request->password,
            'password' => Hash::make($request->password),
            'verify_key' => $str,
        ]);

        // dd($user);
        $details = [
            'nik' => $request->nik,
            'website' => 'http://127.0.0.1:8000/',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/register/verify/' . $str
        ];

        Mail::to($request->email)->send(new MailSend($details));

        Alert::success('Link Verifikasi telah dikirim', 'Silahkan periksa email anda untuk verifikasi email.');
        return view('auth.login');            
    }

    public function verify($verify_key)
    {
        $user = User::where('verify_key', $verify_key)->first();
        
        if ($user) {
            $user->email_verified_at = now();
            $user->save();
            return "Verifikasi link berhasil, silahkan login";            
        }else{
            return "Key tidak valid!";
        }
    }
}
