<?php

class IndexController extends BaseController
{

    private $viewVars = [];
    private $model = 'Player';

    function __construct()
    {

    }

    function setVarsByInput()
    {
        $this->viewVars['name'] = Input::get('name');
        $this->viewVars['login'] = Input::get('login');
        $this->viewVars['email'] = Input::get('email');
        $this->viewVars['password'] = Input::get('password');
    }

    function setViewVarsStandart($message = '', $player = '')
    {
        $this->viewVars['name'] = '';
        $this->viewVars['login'] = '';
        $this->viewVars['password'] = '';
        $this->viewVars['email'] = '';
        $this->viewVars['message'] = $message;
        $this->viewVars['player'] = $player;
    }

    public function is_login_free($log)
    {
        $this->viewVars['players'] = Player::all();
        foreach ($this->viewVars['players'] as $p) {
            if ($p->login == $log)
                return 1;
        }
        return 0;
    }

    public function is_mail_free($mail)
    {
        $this->viewVars['players'] = Player::all();
        foreach ($this->viewVars['players'] as $p) {
            if ($p->email == $mail)
                return 1;
        }
        return 0;
    }

    public function login()
    {
        if (Auth::check()) {

            $model = $this->model;

            $c = CityLibrary::getRandomFreeCity();
            $this->viewVars['random_city'] = $c->name;
            $this->setViewVarsStandart();
            $this->viewVars['cities'] = City::all(); //Исправить этот ужасный код

            $this->putCitySession($c);

            return View::make('frontend.personal_area', $this->viewVars);
        } else {

            $model = $this->model;
            if (Input::has('email')) {
                $data = Input::all();

                /*$player = Player::login($data);

                $c = CityLibrary::getRandomFreeCity();
                $this->viewVars['random_city'] = $c->name;
                $this->putCitySession($c);

                if (!$player) {
                    $this->setViewVarsStandart('Неверное имя пользователя или пароль');
                    return View::make('frontend.index', $this->viewVars);
                } else {
                    $this->setViewVarsStandart('', $player);
                    return View::make('frontend.personal_area', $this->viewVars);
                }*/
                $c = CityLibrary::getRandomFreeCity();
                $this->viewVars['random_city'] = $c->name;
                $this->putCitySession($c);
                $this->setViewVarsStandart();
                return View::make('frontend.index', $this->viewVars);
            } else {
                $c = CityLibrary::getRandomFreeCity();
                $this->viewVars['random_city'] = $c->name;
                $this->putCitySession($c);
                $this->setViewVarsStandart();
                return View::make('frontend.index', $this->viewVars);
            }
        }
    }

    public function add()
    {
        $model = $this->model;

        $data = Input::all();

        $rules = [
            'name' => 'required|min:4',
            'login' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];

        $val = Validator::make($data, $rules);
        $m = '';
        if (Input::has('a')) {
            $m = 'Вы успешно попробовали завоевать город в тестовом режиме. Зарегистрируйтесь, '
                . 'чтобы первыми узнать о старте бета-версии версии игры.';
        }

        $this->setViewVarsStandart($m);

        if (Input::has('name')) {
            $q = new Player;
            if ($val->fails()) {
                $this->setVarsByInput();
                $this->viewVars['message'] = 'Корректно заполните все поля';
            } elseif ($this->is_login_free(Input::get('login')) == 1) {
                $this->setVarsByInput();
                $this->viewVars['message'] = 'Введенный логин уже занят';
            } elseif ($this->is_mail_free(Input::get('email')) == 1) {
                $this->setVarsByInput();
                $this->viewVars['message'] = 'Введенный E-mail уже занят';
            } else {
                $q->add(Input::get('name'), Input::get('login'), Input::get('password'), Input::get('email'));
                $this->setViewVarsStandart('Спасибо за регистрацию.');
                return View::make('frontend.message', $this->viewVars);
            }
            /* if ($q->add(Input::get('name'), Input::get('login'), Input::get('password'), Input::get('email'))) {
              /*if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
              return Redirect::intended('frontend.successful_registration');
              } */
            /*    $this->viewVars['message'] = 'Вы успешно зарегистрированы ';
              } else {

              } */
        }
        return View::make('frontend.register', $this->viewVars);
    }

    public function rate()
    {
        Player::setPoints();
        return View::make('frontend.rating', $this->viewVars);
    }

    private function putCitySession($c)
    {
        Session::put('city', $c->name);
        Session::put('cityPopulation', $c->population);
    }

    /* -------------------------------------------------
      HELPER FUNCTIONS
      -------------------------------------------------- */
}
