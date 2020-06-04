<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Muhammad Harisz Ryadi',
            'email' => 'haris.ryadi@greenlabgroup.com',
            'password' => bcrypt('admin')
        ]);
    }
}
