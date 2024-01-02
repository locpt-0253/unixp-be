<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\LikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\NotificationController;
use App\Models\Question;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/question/all', [QuestionController::class, 'index']); //OK
Route::get('/questions/{id}', [QuestionController::class,'show']); //OK
Route::get('/tag/all', [TagController::class, 'index']); //OK
Route::get('/tag/top-tags', [TagController::class,'top']);
Route::get('/search', [QuestionController::class,'search']); //OK
Route::get('/user/{id}/notifications', [NotificationController::class, 'show']);
Route::get('/user/{id}', [UserController::class, 'show']);

Route::post('/questions', [QuestionController::class, 'store']);
Route::post('/questions/{question}/answers', [AnswerController::class, 'store']);

Route::put('/questions/{id}/accept', [QuestionController::class, 'accept']);

