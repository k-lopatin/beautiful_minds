<?php

class Player extends Eloquent
{
    
    protected $table = 'players';
    public $timestamps = false; //delete updated_at and created_at properties

    public function add($name, $login, $password, $email){
        if($name == '' || iconv_strlen($name,'UTF-8')<2){
            return 0;
        }
        if($login == '' || strlen( $login ) < 2){
            return 0;
        }
        if($password == '' || strlen( $password ) < 2){
            return 0;
        }
        if($email == '' || strlen( $email ) < 5){
            return 0;
        }
        $password = Hash::make($password);
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->save();
        return 1;
    }



}