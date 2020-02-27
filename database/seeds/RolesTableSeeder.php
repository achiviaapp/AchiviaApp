<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'root',
        ]);
        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'admin',
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'Sales Team Leader',
        ]);
        DB::table('roles')->insert([
            'id' => 4,
            'name' => 'sale Man',
        ]);

        DB::table('roles')->insert([
            'id' => 5,
            'name' => 'client',
        ]);
        DB::table('roles')->insert([
            'id' => 6,
            'name' => ' Marketer',
        ]);

         DB::table('roles')->insert([
            'id' => 7,
            'name' => 'Moderation',
        ]);

        DB::table('roles')->insert([
            'id' => 8,
            'name' => 'Sales Manager',
        ]);

        DB::table('roles')->insert([
            'id' => 9,
            'name' => 'Marketing Manager',
        ]);
        DB::table('roles')->insert([
            'id' => 10,
            'name' => 'Visit Dubai',
        ]);

        DB::table('roles')->insert([
            'id' =>11,
            'name' => 'Ambassador',
        ]);

    }
}
