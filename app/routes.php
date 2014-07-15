<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/**
 * Admin routes
 */
Route::get('/', 'HomeController@showWelcome');
Route::get('admin/categories', 'CategoriesController@addCat');
Route::post('admin/categories', 'CategoriesController@addCat');
Route::get('admin/categories/{id}', 'CategoriesController@editCat');
Route::post('admin/categories/{id}', 'CategoriesController@editCat');
Route::any('admin/categories/del/{id}', 'CategoriesController@delCat');

/**
 * Question with number answers
 */
Route::any('admin/', 'QuestionNumberController@add');
Route::any('admin/q_numbers', 'QuestionNumberController@add');
Route::any('admin/q_numbers/{id}', 'QuestionNumberController@edit');
Route::any('admin/q_numbers/del/{id}', 'QuestionNumberController@delete');
Route::any('admin/q_numbers/cat/{id}', 'QuestionNumberController@showFromCat');