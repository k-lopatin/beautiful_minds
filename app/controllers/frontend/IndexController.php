<?php

class IndexController extends BaseController
{
    private $viewVars = [];

    private $model = 'Register';

    function __construct(){
        $this->viewVars['name'] = '';
        $this->viewVars['login'] = '';
        $this->viewVars['password'] = '';
        $this->viewVars['email'] = '';
    }

    public function Register()
    {
        return View::make('frontend.Register');
    }

    public function add()
    {
        $model = $this->model;

        if (Input::has('name')) {
            $q = new Register;
            if ($q->add(Input::get('name'), Input::get('login'), Input::get('password'), Input::get('email'))) {
                $this->viewVars['message'] = 'Вопрос успешно добавлен!';
            } else {
                $this->viewVars['name'] = Input::get('name');
                $this->viewVars['login'] = Input::get('login');
                $this->viewVars['email'] = Input::get('email');
                $this->viewVars['password'] = Input::get('password');
                $this->viewVars['password'] = Hash::make('secret');
            }
        }
        return View::make('frontend.Register', $this->viewVars);
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
