<?php

use Illuminate\Http\Request;
use App\Affirmation;
use App\Http\Resources\AffirmationResource;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/affirmation', function(){
    return AffirmationResource::collection(Affirmation::all());
})->name('affAPI');