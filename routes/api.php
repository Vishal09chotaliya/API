<?php

use App\Http\Controllers\Studentcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function(){
    return ['name' => 'vishal', 'surname' => 'chotaliya'];
});

Route::get('/listing', [Studentcontroller::class, 'list']);

Route::post('/add-user', [Studentcontroller::class, 'addUser']);

Route::put('/update-user', [Studentcontroller::class, 'update']);

Route::delete('/delete-user/{id}', [Studentcontroller::class, 'deleteUser']);

Route::get('/search-student/{id}', [Studentcontroller::class, 'searchStudent']);