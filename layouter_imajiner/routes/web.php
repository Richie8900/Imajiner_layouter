<?php

use App\Models\Pages;
use Illuminate\Support\Facades\Route;
use App\Models\TestTable;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\DataSyncController;
use App\Http\Controllers\RouteController;

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
    return view('home');
});

Route::get('/componentPreview/{category}/{id}', function ($category, $id) {
    if ($category == 'header') {
        DataSyncController::syncHeader($id);
    } else if ($category == 'footer') {
        DataSyncController::syncFooter($id);
    } else if ($category == 'component') {
        DataSyncController::syncComponent($id);
    } else {
        abort(404);
    }
    return view('Preview/Preview', ['category' => $category, 'id' => $id]);
});

Route::get('/test', function () {
    $data = Pages::where('route', 'testing')->get();
    // $data = Pages::all();
    dd(count($data));
    return view('landingPage', ['data' => $data[0]]);
});

Route::get('/{slug}', [RouteController::class, 'getStaticRoute']);

Route::get('/{category}/{slug}', [RouteController::class, 'getDynamicRoute']);
