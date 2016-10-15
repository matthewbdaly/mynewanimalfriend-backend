<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add Pets
        DB::table('pets')->insert([[
            'name' => 'Freddie',
            'type' => 'Cat',
            'available' => 1,
            'picture'   => 'https://placekitten.com/300/300',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], [
            'name' => 'Sophie',
            'type' => 'Cat',
            'available' => 1,
            'picture'   => 'https://placekitten.com/300/300',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]]);
    }
}
