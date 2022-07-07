<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalControllerRequest;
use App\Models\Animal;
use App\Models\Kind;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
{
    public function list(): JsonResponse
    {
        $animals = Animal::with('kind')->get();
        return response()->json($animals)->setStatusCode(200);
    }

    public function show(Request $request): JsonResponse
    {
        $animal = Animal::query()->findOrFail($request['id']);
        return response()->json($animal->toArray())->setStatusCode(200);
    }

    public function create(Request $request): JsonResponse
    {
        $faker = fake();

        $res = (new Animal)->fill(
            [
            'name' => $faker->name,
            'kind_id' => $request['kind_id'],
            'age' => 1,
            'size' => $faker->numberBetween(10, 30),
            'food' => 100,
            'state' => 'growing'
            ]
        )->save();

        return response()->json(['status' => $res])->setStatusCode(201);
    }

    public function age(Request $request)
    {
        $animal = Animal::with('kind')->findOrFail($request['id']);
        $animal->age = $animal->kind->max_age;
        $animal->save();
    }

    public function delete(Request $request): JsonResponse
    {
        $animal = Animal::query()->findOrFail($request['id']);
        $res = $animal->delete();
        return response()->json(['status' => $res])->setStatusCode(201);
    }

    public function kill(): JsonResponse
    {
        $animals = Animal::all();
        foreach ($animals as $animal){
            $animal->delete();
            $animal->save();
        }
        return response()->json(['status' => 'all killed'])->setStatusCode(201);
    }

    public function kinds(): JsonResponse
    {
        $kinds = Kind::all();
        return response()->json($kinds)->setStatusCode(200);
    }
}
