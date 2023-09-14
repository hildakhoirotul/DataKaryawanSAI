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
            'nama' => 'Nissa Cresswell',
            'is_admin'=> true,
            'email'=>'admin0@gmail.com',
            'email_verified_at'=>now(),
            'chain'=> '000000010199',
            'initial_pass'=> '000000010199',
            'password'=> Hash::make('000000010199'),
            'verify_key'=>$str,
        ]);
        DB::table('users')->insert([
            'nik' => '111111',
            'nama' => 'Pamela Regglar',
            'is_admin' => false,
            'email'=>'user1@gmail.com',
            'email_verified_at'=>now(),
            'chain' => '111111010101',
            'initial_pass' => '111111010101',
            'password' => Hash::make('111111010101'),
            'verify_key'=>$str,
        ]);
        DB::table('users')->insert([
            'nik' => '222222',
            'nama' => 'James Binder',
            'is_admin' => false,
            'email'=>'user2@gmail.com',
            'email_verified_at'=>now(),
            'chain' => '222222020202',
            'initial_pass' => '222222020202',
            'password' => Hash::make('222222020202'),
            'verify_key'=>$str,
        ]);
        DB::table('users')->insert([
            'nik' => '333333',
            'nama' => 'Bobbie Oldacres',
            'is_admin' => true,
            'email'=>'admin3@gmail.com',
            'email_verified_at'=>now(),
            'chain' => '333333010199',
            'initial_pass' => '333333010199',
            'password' => Hash::make('333333010199'),
            'verify_key'=>$str,
        ]);
    }
}
