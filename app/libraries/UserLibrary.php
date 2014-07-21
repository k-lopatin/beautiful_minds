<?php

/**
*
*/
class UserLibrary
{

	/**
	 * check if admin is logged in. If not shows login form.
	 * return true;
	 */
	static public function loginAdmin()
	{
		if (Auth::check() && Auth::id() == 1)
		{
		    return true;
		}
		if(Input::has('name') && Input::has('password')){
			if ( Auth::attempt( array('name' => Input::get('name'), 'password' => Input::get('password') ), true) )
			{
				return true;
			}
		}
		echo View::make('admin.loginForm', array( 'form_url' => Route::current()->getPath() ) );
		return false;
	}
}
