<?php

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
