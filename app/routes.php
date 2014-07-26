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

/**
 * Categories of Questions
*/
Route::any('admin/categories', 'CategoriesController@addCat');
Route::any('admin/categories/{id}', 'CategoriesController@editCat');
Route::any('admin/categories/del/{id}', 'CategoriesController@delCat');

/**
 * Question with number answers
 */
Route::any('admin/', 'QuestionNumberController@add');
Route::any('admin/q_numbers', 'QuestionNumberController@add');
Route::any('admin/q_numbers/{id}', 'QuestionNumberController@edit');
Route::any('admin/q_numbers/del/{id}', 'QuestionNumberController@delete');

/**
 * Question with word answers
 */
Route::any('admin/q_words', 'QuestionWordController@add');
Route::any('admin/q_words/{id}', 'QuestionWordController@edit');
Route::any('admin/q_words/del/{id}', 'QuestionWordController@delete');

/**
 * Question with test answers
*/
Route::any('admin/q_tests', 'QuestionTestController@add');
Route::any('admin/q_tests/{id}', 'QuestionTestController@edit');
Route::any('admin/q_tests/del/{id}', 'QuestionTestController@delete');

/**
 * Question with answers to order
*/
Route::any('admin/q_order', 'QuestionOrderController@add');
Route::any('admin/q_order/{id}', 'QuestionOrderController@edit');
Route::any('admin/q_order/del/{id}', 'QuestionOrderController@delete');

/**
 * Question with answers on map
*/
Route::any('admin/q_maps', 'QuestionMapController@add');
Route::any('admin/q_maps/{id}', 'QuestionMapController@edit');
Route::any('admin/q_maps/del/{id}', 'QuestionMapController@delete');

/**
 * Question List
*/
Route::any('admin/qlist', 'QuestionController@showList');

/**
* END ROUTES
*/