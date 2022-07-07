<?php

namespace App\Console\Commands;

use App\Helpers\StateHelper;
use App\Models\Animal;
use Illuminate\Console\Command;

class CheckAnimals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animals:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check animals';



    public function handle()
    {
        $animals = Animal::with('kind')->get();

        foreach ($animals as $animal){
            StateHelper::apply($animal);

            if($animal->state === 'growed'){
                continue;
            }

            $animal->size = ceil($animal->size * $animal->kind->growth_factor);
            $animal->age = $animal->age+1;

            $animal->save();
        }
    }
}
