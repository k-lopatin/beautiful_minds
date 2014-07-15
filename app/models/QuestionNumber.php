<?php

class QuestionNumber extends Eloquent
{

    protected $table = 'q_numbers';
    public $timestamps = false; //delete updated_at and created_at properties

    public function add($statement, $answer, $complexity, $category, $plustime, $description){
        if($statement == '' || strlen( $statement ) < 5){
            return 0;
        }
        if($answer == '' || !is_numeric($answer)){
            return 0;
        }
        if($complexity == '' || !is_numeric($complexity) || $complexity < 0 || $complexity > 10 ){
            return 0;
        }
        if($category == '' || !is_numeric($category) || $category < 0 ){
            return 0;
        }
        if( !is_numeric($plustime) ){
            return 0;
        }
        $this->statement = $statement;
        $this->answer = $answer;
        $this->complexity = $complexity;
        $this->category = $category;
        $this->plustime = $plustime;
        $this->description = $description;
        $this->save();
        return 1;
    }
    public function edit($statement, $answer, $complexity, $category, $plustime, $description){
        if($statement == '' || strlen( $statement ) < 5){
            return 0;
        }
        if($answer == '' || !is_numeric($answer)){
            return 0;
        }
        if($complexity == '' || !is_numeric($complexity) || $complexity < 0 || $complexity > 10 ){
            return 0;
        }
        if($category == '' || !is_numeric($category) || $category < 0 ){
            return 0;
        }
        if( !is_numeric($plustime) ){
            return 0;
        }
        $this->statement = $statement;
        $this->answer = $answer;
        $this->complexity = $complexity;
        $this->category = $category;
        $this->plustime = $plustime;
        $this->description = $description;
        $this->save();
        return 1;
    }

}