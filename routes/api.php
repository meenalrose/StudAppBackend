<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/teachers', 'TeachersController@teachersList');

Route::post('/student', 'StudentsController@storeStudent');
Route::get('/studentsList', 'StudentsController@studentsList');
Route::patch('/student/{$id}, StudentsController@updateStudent');
Route::delete('/student/{studentId}, StudentsController@delete');
Route::get('/genderList', 'StudentsController@getGender');

Route::get('/marksList', 'MarksController@marksList');
Route::post('/marks', 'MarksController@storeMarks');
Route::post('/marks/{$id}, MarksController@updateMarks');
Route::delete('/marks/{markId}, MarksController@delete');
Route::get('/termList', 'MarksController@getTerms');

