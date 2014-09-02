<?php

class Player extends Eloquent
{
    
    protected $table = 'players';


    public function add($name, $login, $password, $email){
        if($name == '' || strlen( $name ) < 2){
            return 0;
        }
        if($login == '' || strlen( $login ) < 2){
            return 0;
        }
        if($password == ''){
            return 0;
        }
        if($email == '' || strlen( $email ) < 5){
            return 0;
        }
        $password = Hash::make('secret');
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->save();
        return 1;
    }



}