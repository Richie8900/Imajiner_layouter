<?php

use App\Models\Pages;
use Illuminate\Support\Facades\Route;
use App\Models\TestTable;
use Illuminate\Support\Facades\File;

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
    return view('welcome');
});

Route::get('/example', function () {
    return view('example');
});

Route::get('/test', function () {
    $script = TestTable::where('LayoutName', 'ets')->get();
    $path = resource_path('views/test1.blade.php');
    File::put($path, $script[0]->Script);

    // dd($script[0]->Script);
    return view('test1', ['script' => $script]);
});
Route::get('//testing1', function () {
    return '/testing1 route';
});
Route::get('/test2', function () {
    return 'test2 route';
});
// Route::get('/test3', function () { return 'test3 route'; });
Route::get('/test3', function () {
    // dd(Pages::where('PageName', 'testing3')->get());
    $script = Pages::where('Route', 'test3')->get();
    $path = resource_path('views/testing3.blade.php');
    File::put($path, $script[0]->Script);

    // dd($script[0]->Script);
    return view('testing3', ['script' => $script]);
});
Route::get('/test4', function () {
    return 'test4 route';
});
Route::get('/test5', function () {
    return 'test5 route';
});
Route::get('/test6', function () {
    return 'test6 route';
});
Route::get('/test7', function () {
    return 'test7 route';
});
Route::get('/test8', function () {
    return view('test8');
});
Route::get('/testing9', function () {
    return 'testing9';
});
Route::get('/test9', function () {
    // dd(Pages::where('Route', 'test9')->first()->Route);
    return view('test9', ['data' => Pages::where('Route', 'test9')->first()]);
});
