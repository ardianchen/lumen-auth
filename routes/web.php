<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function (Request $request) use ($app) {
    $user = User::first();

    return $user;
});

$app->get('/login', function (Request $request) {
    $token = app('auth')->attempt($request->only('email', 'password'));

    return response()->json(compact('token'));
});

$app->group(['middleware' => 'jwt.auth'], function () use ($app) {
    $app->get('/me', function (Request $request) {
        return $request->user();
    });
});