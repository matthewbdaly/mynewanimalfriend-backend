<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add user
        DB::table('users')->insert([
            'name' => 'bobsmith',
            'email' => 'bob@example.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'password' => Hash::make("password")
        ]);
    }
}
