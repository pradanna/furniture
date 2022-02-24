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
            'name'      => 'awang kuncoro',
            'email'     => 'admin@gmail.com',
            'phone'     => '082142404299',
            'password'  => Hash::make('password'),
        ]);
    }
}
