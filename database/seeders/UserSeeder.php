<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = Str::random(100);
        DB::table('users')->insert([
            'nik' => '000000',
            'nama' => 'Admin 00',
            'is_admin'=> true,
            'email'=>'admin0@gmail.com',
            'email_verified_at'=>now(),
            'chain'=> '000000010101',
            'initial_pass'=> '000000010101',
            'password'=> Hash::make('000000010101'),
            'verify_key'=>$str,
        ]);
        DB::table('users')->insert([
            'nik' => '111111',
            'nama' => 'Admin 01',
            'is_admin' => true,
            'email'=>'admin1@gmail.com',
            'email_verified_at'=>now(),
            'chain' => '111111010101',
            'initial_pass' => '111111010101',
            'password' => Hash::make('111111010101'),
            'verify_key'=>$str,
        ]);
    }
}
