<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin')
        ]);

        User::create([
            'name' => 'Sallie Eky',
            'username' => 'sallieeky',
            'email' => 'sallieeky@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        User::create([
            'name' => 'Sallie Mansurina',
            'username' => 'salliemansurina',
            'email' => '10191077@student.itk.ac.id',
            'password' => bcrypt('12345678')
        ]);
    }
}
