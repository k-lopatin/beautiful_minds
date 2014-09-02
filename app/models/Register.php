<?php

class Register extends Eloquent
{
    
    protected $table = 'players';


    public function edit($name, $surname, $login, $password, $email){
        if($name == '' || strlen( $name ) < 2){
            return 0;
        }
        if($surname == '' || strlen( $surname ) < 2){
            return 0;
        }
        if($login == '' || strlen( $login ) < 2){
            return 0;
        }
        if($password == '' || !(Hash::check('secret', $password))){
            return 0;
        }
        if($email == '' || strlen( $email ) < 5){
            return 0;
        }
        $this->name = $name;
        $this->surname = $surname;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->save();
        return 1;
    }



}