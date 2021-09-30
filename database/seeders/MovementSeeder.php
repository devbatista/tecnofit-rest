<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movement;

class MovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movement::create([
            'id' => 1,
            'name' => 'Deadlift'
        ]);

        Movement::create([
            'id' => 2,
            'name' => 'Back Squat'
        ]);

        Movement::create([
            'id' => 3,
            'name' => 'Bench Press'
        ]);
    }
}
