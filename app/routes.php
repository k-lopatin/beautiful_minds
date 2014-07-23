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
Route::any('admin/logout', function(){
	Auth::logout();
	return Redirect::to('admin');
});

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
/**
 * Question with word answers
 */
Route::any('admin/', 'QuestionWordController@add');
Route::any('admin/q_words', 'QuestionWordController@add');
Route::any('admin/q_words/{id}', 'QuestionWordController@edit');
Route::any('admin/q_words/del/{id}', 'QuestionWordController@delete');
Route::any('admin/q_words/cat/{id}', 'QuestionWordController@showFromCat');
/**
 * Question with test answers
*/

Route::any('admin/', 'QuestionTestController@add');
Route::any('admin/q_tests', 'QuestionTestController@add');
Route::any('admin/q_tests/{id}', 'QuestionTestController@edit');
Route::any('admin/q_tests/del/{id}', 'QuestionTestController@delete');
Route::any('admin/q_tests/cat/{id}', 'QuestionTestController@showFromCat');


Route::any('admin/qlist', 'QuestionController@showList');

/**
* END ROUTES
*/