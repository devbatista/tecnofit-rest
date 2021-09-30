<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Joao'
        ]);

        User::create([
            'id' => 2,
            'name' => 'Jose'
        ]);

        User::create([
            'id' => 3,
            'name' => 'Paulo'
        ]);

    }
}
