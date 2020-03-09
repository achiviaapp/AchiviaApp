<?php

use Illuminate\Database\Seeder;

class RotationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'rotation',
            'type' => 1,
        ]);
        DB::table('settings')->insert([
            'name' => 'limitation',
            'type' => 1,
            'userNo' => 20,
        ]);
    }
}
