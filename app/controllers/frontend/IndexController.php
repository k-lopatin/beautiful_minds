<?php

class IndexController extends BaseController
{
    private $viewVars = [];

    private $model = 'Player';

    function __construct(){
        $this->viewVars['name'] = '';
        $this->viewVars['login'] = '';
        $this->viewVars['password'] = '';
        $this->viewVars['email'] = '';
        $this->viewVars['message'] = '';
    }

    public function add()
    {
        $model = $this->model;
        if (Input::has('name') ) {
            $q = new Player;
            if ($q->add(Input::get('name'), Input::get('login'), Input::get('password'), Input::get('email'))) {
                /*if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
                    return Redirect::intended('frontend.successful_registration');
                }*/
                $this->viewVars['message'] = 'Вы успешно зарегистрированы ';
            } else {
                $this->viewVars['name'] = Input::get('name');
                $this->viewVars['login'] = Input::get('login');
                $this->viewVars['email'] = Input::get('email');
                $this->viewVars['password'] = Input::get('password');
                $this->viewVars['message'] = 'Корректно заполните все поля';
            }
        }
        return View::make('frontend.register', $this->viewVars);
    }

    public function index()
    {
        $c = CityLibrary::getRandomFreeCity();
        $this->viewVars['random_city'] = $c->name;

        return View::make('frontend.index', $this->viewVars);
    }



    /*-------------------------------------------------
        HELPER FUNCTIONS
        --------------------------------------------------*/


}
