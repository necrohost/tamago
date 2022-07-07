<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $files = Storage::disk('public')->allFiles('animals');
        $faker = fake();
        foreach ($files as $file){
            DB::table('kinds')->insert([
                'kind' => basename($file, ".png"),
                'max_size' => $faker->numberBetween(80, 120),
                'max_age' => $faker->numberBetween(30, 100),
                'growth_factor' => $faker->randomFloat(2, 1.3, 2),
                'img' => $file,
            ]);
        }
    }
}
