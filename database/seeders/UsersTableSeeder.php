<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        DB::table('users')->insert([
            'name' => 'WaveXpay Info',
            'email' => 'info@wavexpay.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@wavexpay.com',
            'password' => bcrypt('password'),
        ]);
    }
}

// php artisan db:seed --class=UsersTableSeeder