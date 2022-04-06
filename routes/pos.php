<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SubCategory;
use App\Http\Controllers\Pos\MainController;

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


Route::middleware(['auth:admin'])->prefix('point-of-sale')->group(function() {

	Route::get('/', [MainController::class, 'index'])->name('pos.index');

	Route::get('/sub-categories', function() {

		$sub_categories = SubCategory::Branch()->get();

		return response()->json($sub_categories);

	})->name('pos.sub-categories');

  


});