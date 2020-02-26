<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'Lets Talk',
            'email' => 'koray@letstalk.nl',
            'is_admin' => true,
            'password' => Hash::make('letstalk'),
        ]);
    }
}
