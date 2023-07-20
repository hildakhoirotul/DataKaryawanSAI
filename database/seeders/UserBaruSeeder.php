<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserBaruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'pengguna0',
            'username' => '00000000',
            // 'is_admin' => '0',
            'email' => 'pengguna0@gmail.com',
            'password' => Hash::make('00000000')
        ]);
        DB::table('users')->insert([
            'name' => 'admin1',
            'username' => '11111111',
            // 'is_admin' => '1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('11111111')
        ]);
    }
}
