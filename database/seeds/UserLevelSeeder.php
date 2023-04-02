<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        DB::table('user_level')->insert([
            ['id' => 1, 'name' => 'Super Admin', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Mitra', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Reseller', 'created_at' => $now, 'updated_at' => $now]
        ]);
    }
}
