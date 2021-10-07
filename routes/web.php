<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () { return view('welcome'); });
Route::get('/home', function () { echo 'This is home page'; });
Route::get('/about', function () { echo 'This is About page'; })->middleware('checkage');

Route::get('/category/all', [App\Http\Controllers\CategoryController::class, 'AllCat'])->name('category.all');
Route::post('/category/add', [App\Http\Controllers\CategoryController::class, 'AddCat'])->name('category.store');
Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'Edit']);
Route::get('/category/restore/{id}', [App\Http\Controllers\CategoryController::class, 'Restore']);
Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'Update']);
Route::get('/category/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'Destroy']);
Route::get('/category/softDelete/{id}', [App\Http\Controllers\CategoryController::class, 'SoftDelete']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();

    return view('dashboard', compact('users'));
})->name('dashboard');
