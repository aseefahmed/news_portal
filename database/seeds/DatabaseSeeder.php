<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Aseef',
            'last_name' => 'Ahmed',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => '1'

        ]);
    }
}
