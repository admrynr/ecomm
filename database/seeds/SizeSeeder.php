<?php

use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();

        DB::table('sizes')->insert([
            ['name' => 'xs', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 's', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'l', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'xl', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'xxl', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'xxxl', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
