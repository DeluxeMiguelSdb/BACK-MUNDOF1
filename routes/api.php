<?php

use App\Http\Controllers\ApuestaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\RoleAuthController;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['cors'])->group(function () {
    Route::post('/hogehoge', 'Controller@hogehoge');
});

Route::get('/login-requires', function () {
    return  response()->json(['data' => 'no tienes permiso'], 403);
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::any('/me', [AuthController::class, 'me']);
    Route::post('/getallusers', [AuthController::class, 'getallusers']);
    
    Route::post('/changeNick', [AuthController::class, 'changeNick']);
    Route::post('/changeNombre', [AuthController::class, 'changeNombre']);
    Route::post('/changeApellidos', [AuthController::class, 'changeApellidos']);
    Route::post('/changePassword', [AuthController::class, 'changePassword']);
    Route::post('/concederpermisoadmin', [AuthController::class, 'concederpermisoadmin']);
    
    Route::resource('/noticias', NewsController::class);
    Route::get('/noticias/{id}','NewsController@show');
    Route::resource('/estadisticas', ApiController::class);
    
    Route::any('/permissions', [RoleAuthController::class, 'UserPermissions']);
    
    Route::resource('/comentario', 'App\Http\Controllers\ComentarioController');
    Route::delete('/eliminarcomentario/{id}', [ComentarioController::class, 'eliminarcomentario']);
    Route::post('/addcomentario', [ComentarioController::class, 'addcomentario']);
    

    Route::post('/registrarapuesta', [ApuestaController::class, 'registrarapuesta']);
    Route::post('/getapuesta', [ApuestaController::class, 'getapuesta']);
    Route::post('/getapuestasbyiduser', [ApuestaController::class, 'getapuestasbyiduser']);

    Route::get('/getalllogs',[LogController::class, 'getalllogs']);

    
});
