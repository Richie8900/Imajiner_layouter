<?php

use App\Models\Pages;
use Illuminate\Support\Facades\Route;
use App\Models\TestTable;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\DataSyncController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    // Additional routes for your application can go here
});

Route::get('/', function () {
    return view('LandingPage');
});

Route::get('/rebirth', function () {
    Artisan::call('rebirth');
    return Redirect::to('/');
});

Route::get('/componentPreview/{category}/{id}', function ($category, $id) {
    return view('Preview/Preview', ['category' => $category, 'id' => $id]);
});

Route::get('/{slug}', [RouteController::class, 'getStaticRoute']);

Route::get('/{category}/{slug}', [RouteController::class, 'getDynamicRoute']);
