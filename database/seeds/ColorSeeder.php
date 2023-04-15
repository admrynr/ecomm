<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();


        DB::table('colors')->insert([
            ['name' => 'Red', 'hex_code' => '#FF0000', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Green', 'hex_code' => '#00ff00', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Blue', 'hex_code' => '#0000FF', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
