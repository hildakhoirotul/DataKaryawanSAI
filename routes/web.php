<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\UserController;
use App\Imports\RekapitulasiImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Rekapitulasi;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
// Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login');

// Route::get('/', [RegisterController::class, 'showRegistrationForm']);
Route::get('/register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');
// Route::get('/', function () {
//     if (auth()->check()) {
//         $user = auth()->user();

//         if ($user->is_admin == 1) {
//             return redirect()->route('/dashboard');
//         } else {
//             return redirect()->route('/home');
//         }
//     }

//     return redirect()->route('login');
// });
Auth::routes();
// Route::group(['middleware' => ['web']], function () {
//     Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
//     Route::middleware(['is_user'])->group(function () {
//         Route::get('/home', [UserController::class, 'index'])->name('/home');
//     });
//     Route::middleware(['is_admin'])->group(function () {
//         Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('/dashboard');
//     });
// });

// Route::get('/send-email', [LoginController::class, 'email'])->name('send-email');
Route::get('/lupa-password', [LoginController::class, 'ForgetPassword'])->name('lupa-password');
Route::post('/lupa-password', [LoginController::class, 'GetEmail'])->name('lupaPassword');

Route::controller(UserController::class)->group(function () {
    Route::get('/home', 'index')->middleware('is_user')->name('home');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->middleware('is_admin')->name('dashboard');
    Route::get('/absensi', 'absensi')->middleware('is_admin')->name('absensi');
    Route::get('/data-ochi', 'ochi')->middleware('is_admin')->name('data-ochi');
    Route::get('/data-qcc', 'qcc')->middleware('is_admin')->name('data-qcc');
    Route::get('/karyawan', 'karyawan')->middleware('is_admin')->name('karyawan');
    Route::get('/pengaturan', 'setting')->middleware('is_admin')->name('setting');
    Route::get('/export-excel', 'exportExcel')->name('export.excel.submit');
    Route::get('/export-absensi', 'exportAbsensi')->name('export.absensi.submit');
    Route::get('/export-ochi', 'exportOchi')->name('export.ochi.submit');
    Route::get('/export-qcc', 'exportQcc')->name('export.qcc.submit');
    Route::post('/import-excel', 'importExcel')->name('import.excel.submit');
    Route::post('/import-absensi', 'importAbsensi')->name('import.absensi.submit');
    Route::post('/import-ochi', 'importOchi')->name('import.ochi.submit');
    Route::post('/import-qcc', 'importQcc')->name('import.qcc.submit');
    Route::post('/import-karyawan', 'importKaryawan')->name('import.karyawan.submit');
    Route::get('/filter-absensi', 'filterAbsensi')->name('filter.absensi');
    Route::get('/filter-ochi', 'filterOchi')->name('filter.ochi');
    Route::get('/filter-qcc', 'filterQcc')->name('filter.qcc');
    Route::post('/disable-login', 'settingLogin')->name('disable.login');
    Route::get('/search-rekap', 'searchRekap')->name('search.rekap');
    Route::get('/search-karyawan', 'searchKaryawan')->name('search.karyawan');
    // Route::get('/search-absensi', 'searchAbsensi')->name('search.absensi');

});

Route::controller(HomeController::class)->group(function () {
    Route::get('/change-password', 'showChangePassword')->name('change-password');
    Route::post('/change-password', 'changePassword')->name('changePassword');
});

// Route::controller(SignInController::class)->group(function () {
//     Route::post('/sign-in', 'login')->name('sign-in');
// });
