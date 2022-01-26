<?php

use App\Http\Livewire\AccesGroup;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Home;
use App\Http\Livewire\NewGroup;
use App\Http\Livewire\Group;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Home::class)->name('/');
Route::get('/new-group', NewGroup::class)->name('new-group');
Route::get('/acces-group', AccesGroup::class)->name('acces-group');
Route::get('/group/{group}/{user}', Group::class)->name('group')->middleware('group');
