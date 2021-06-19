<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
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

//---------------------------Task Item routes----------------------------------------
Route::get('/items', [ItemController::class, 'index']);

Route::prefix('/item')->group( function() {
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
    }
);

//---------------------------Comment routes----------------------------------------

Route::get('comments', 'CommentController@index');
Route::post('comment/store', 'CommentController@store');
Route::resource('comment', 'CommentController');


