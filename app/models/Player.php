<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Player extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $table = 'players';
    public $timestamps = false; //delete updated_at and created_at properties

    public function add($name, $login, $password, $email){
        $password = Hash::make($password);
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->save();
        //return 1;
    }
    public static function login($data)
    {
        if (Auth::attempt(array('email' => $data['email'], 'password' => $data['password']))) {
            return Auth::user();
        }
        else
            return false;
    }

}
