<?php

namespace App\Helpers;

use App\Models\Animal;

class StateHelper
{
    public static function apply(Animal $animal): void
    {
        $animal->size >= $animal->kind->max_size ||
        $animal->age === $animal->kind->max_age ? $animal->state = 'growed' : $animal->state = 'growing';

        $animal->save();
    }

    public static function checkGrowing(): bool
    {
        return Animal::query()->whereIn('state', ['growing'])->exists();
    }
}
