<?php

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
        $currentDate = date('Y-m-d H:i:s');

        DB::table('users')->insert([
            'name' => 'Kuthula',
            'email' => 'jklangadev@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => $currentDate,
            'created_at' => $currentDate,
            'updated_at' => $currentDate,
        ]);
    }
}
