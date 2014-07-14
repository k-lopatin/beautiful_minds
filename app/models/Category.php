<?php

class Category extends Eloquent
{

    protected $table = 'categories';
    public $timestamps = false; //delete updated_at and created_at properties

    public function add($name){
        if($name == '' || strlen( $name ) < 3){
            return 0;
        }
        $this->name = $name;
        $this->save();
        return 1;
    }
    public function edit($name){
        if($name == '' || strlen( $name ) < 3){
            return 0;
        }
        $this->name = $name;
        $this->save();
        return 1;
    }

}

