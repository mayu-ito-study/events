<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 3; $i++) {
            DB::table('users')->insert([
                'name' => 'ユーザー' . $i,
                'email' => 'user' . $i . '@test.jp',
                'password' => Hash::make('pass' . $i),
            ]);
        }
    }
}
