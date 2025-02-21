<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});

Route::get('students', [StudentController::class, 'list']);
Route::post('add-student', [StudentController::class, 'addStudent']);
Route::put('update-student', [StudentController::class, 'updateStudent']);
Route::delete('delete-student/{id}', [StudentController::class, 'deleteStudent']);
Route::get('search-student/{name}', [StudentController::class, 'searchStudent']);
Route::post('signup',  [UserAuthController::class, 'signup']);
Route::post('login',  [UserAuthController::class, 'login']);