<?php

declare(strict_types=1);

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function () {

    return 'environment: ' . App::environment() . ' TIMEZONE: ' . config('app.timezone') .
        ' APP_NAME: ' . env('APP_NAME') . ' App::ds ' . App::currentLocale();
});

Route::get('/invoice/id', static function () {
    return 'invoice papa';
});
