<?php

use App\Http\Controllers\Api\AnimalController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([], static function (Router $router) {
        $router->get('kinds', [AnimalController::class, 'kinds']);

        $router->get('animals', [AnimalController::class, 'list']);
        $router->post('animals', [AnimalController::class, 'create']);
        $router->post('animals/age', [AnimalController::class, 'age']);
        $router->post('animals/remove', [AnimalController::class, 'delete']);
        $router->get('animals/kill', [AnimalController::class, 'kill']);
});
