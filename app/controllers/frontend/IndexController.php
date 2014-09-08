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

    function setVarsByInput(){
        $this->viewVars['name'] = Input::get('name');
        $this->viewVars['login'] = Input::get('login');
        $this->viewVars['email'] = Input::get('email');
        $this->viewVars['password'] = Input::get('password');
    }

    public function is_login_free($log)
    {
        $this->viewVars['players'] = Player::all();
        foreach ($this->viewVars['players']  as $p) {
            if($p->login == $log)
                return 1;
        }
        return 0;
    }

    public function is_mail_free($mail)
    {
        $this->viewVars['players'] = Player::all();
        foreach ($this->viewVars['players']  as $p) {
            if($p->email == $mail)
                return 1;
        }
        return 0;
    }

    public function add()
    {
        $model = $this->model;

        $data = Input::all();

        $rules = [
            'name' => 'required|min:6',
            'login' => 'required|min:6',
            'email' => 'required|email|min:6',
            'password' => 'required|min:6'
        ];

        $val = Validator::make($data, $rules);

        if (Input::has('name') ) {
            $q = new Player;
            if($val->fails()) {
                $this->setVarsByInput();
                $this->viewVars['message'] = 'Корректно заполните все поля';
            }
            elseif($this->is_login_free(Input::get('login'))==1){
                $this->setVarsByInput();
                $this->viewVars['message'] = 'Введенный логин уже занят';
            }
            elseif($this->is_mail_free(Input::get('email'))==1){
                $this->setVarsByInput();
                $this->viewVars['message'] = 'Введенный E-mail уже занят';
            }
            else{
                $q->add(Input::get('name'), Input::get('login'), Input::get('password'), Input::get('email'));
            }
            /*if ($q->add(Input::get('name'), Input::get('login'), Input::get('password'), Input::get('email'))) {
                /*if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
                    return Redirect::intended('frontend.successful_registration');
                }*/
            /*    $this->viewVars['message'] = 'Вы успешно зарегистрированы ';
            } else {

            }*/
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
