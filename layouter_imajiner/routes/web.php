<?php

use App\Models\Pages;
use Illuminate\Support\Facades\Route;
use App\Models\TestTable;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\DataSyncController as Sync;

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
        Sync::syncHeader($id);
    } else if ($category == 'footer') {
        Sync::syncFooter($id);
    } else if ($category == 'component') {
        Sync::syncComponent($id);
    } else {
        abort(404);
    }
    return view('Preview/Preview', ['category' => $category, 'id' => $id]);
});

Route::get('/test', function () {
    return view('test-page', ['data' => Pages::where('Route', 'test')->first()]);
});
Route::get('/home', function () {
    return view('home-page', ['data' => Pages::where('Route', 'home')->first()]);
});
Route::get('/about', function () {
    return view('about', ['data' => Pages::where('Route', 'about')->first()]);
});
