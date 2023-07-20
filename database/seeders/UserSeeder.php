<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'nik' => '000000',
            'is_admin'=> true,
            'password'=> Hash::make('000000'),
        ]);
        DB::table('users')->insert([
            'name' => 'pengguna1',
            'nik' => '111111',
            'is_admin' => false,
            'password' => Hash::make('111111')
        ]);
        DB::table('users')->insert([
            'name' => 'pengguna2',
            'nik' => '222222',
            'is_admin' => false,
            'password' => Hash::make('222222')
        ]);
        DB::table('users')->insert([
            'name' => 'admin2',
            'nik' => '333333',
            'is_admin' => true,
            'password' => Hash::make('333333')
        ]);
    }
}
