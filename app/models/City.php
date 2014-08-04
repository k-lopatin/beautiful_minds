<?php

class City extends Eloquent
{
    use QuestionModelTrait;
    
    protected $table = 'cities';
    public $timestamps = false; //delete updated_at and created_at properties

    public function add($name, $country, $population, $description, $files){
        if($name == '' || strlen( $name ) < 3 || !is_string($name)){
            return 0;
        }
        if($country == '' || strlen( $country ) < 3 || !is_string($country)){
            return 0;
        }
        if(!is_numeric($population)){
            return 0;
        }
        $this->name = $name;
        $this->country = $country;
        $this->population = $population;
        $this->description = $description;
        $this->files = $files;
        $this->is_free = 0;
        $this->save();
        return 1;
    }
    public function edit($statement, $answer, $complexity, $category, $plustime, $description, $link, $files){
        if($name == '' || strlen( $name ) < 3 || !is_string($name)){
            return 0;
        }
        if($country == '' || strlen( $country ) < 3 || !is_string($country)){
            return 0;
        }
        if(!is_numeric($population)){
            return 0;
        }
        $this->name = $name;
        $this->country = $country;
        $this->population = $population;
        $this->description = $description;
        $this->files = $files;
        $this->is_free = $is_free;
        $this->save();
        return 1;
    }
}