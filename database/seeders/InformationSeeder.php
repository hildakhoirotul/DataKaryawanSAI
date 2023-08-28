<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information')->insert([
            'information' => 'Konfirmasi Absensi ke EB.',
        ]);
        DB::table('information')->insert([
            'information' => 'Konfirmasi OCHI & QCC ke Training.',
        ]);
        DB::table('information')->insert([
            'information' => 'Maksimal Konfirmasi pada tanggal 20 September 2023 jam 10.00 WIB.',
        ]);
        DB::table('information')->insert([
            'information' => 'Perubahan data dapat dilihat kembali setelah 1 bulan.',
        ]);
        DB::table('information')->insert([
            'information' => 'Sandi dapat diganti di halaman Ganti Sandi.',
        ]);
    }
}
