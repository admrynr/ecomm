<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();


        DB::table('users')->insert([
            ['name' => 'Super Admin', 'phone' => '089688578285', 'password' => bcrypt('password'), 'is_verified' => 1,'level' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);


    }
}
