<?php

namespace Database\Factories;

use App\Models\Kind;
use Illuminate\Database\Eloquent\Factories\Factory;

class KindFactory extends Factory
{
    protected $model = Kind::class;

    public function definition()
    {
        $faker = fake();
        return [
            'max_size' => $faker->numberBetween(80, 120),
            'max_age' => $faker->numberBetween(30, 100),
            'growth_factor' => $faker->randomFloat(2, 1.3, 3),
        ];
    }
}
