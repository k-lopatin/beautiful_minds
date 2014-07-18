<?php

class QuestionWord extends Eloquent
{

    protected $table = 'q_words';
    public $timestamps = false; //delete updated_at and created_at properties

    public function add($statement, $answer, $complexity, $category, $plustime, $description, $link, $files){
        if($statement == '' || strlen( $statement ) < 5){
            return 0;
        }
        if($answer == '' || !is_string($answer)){
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
        $this->link = $link;
        $this->files = $files;
        $this->save();
        return 1;
    }
    public function edit($statement, $answer, $complexity, $category, $plustime, $description, $link, $files){
        if($statement == '' || strlen( $statement ) < 5){
            return 0;
        }
        if($answer == '' || !is_string($answer)){
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
        $this->link = $link;
        $this->files = $files;
        $this->save();
        return 1;
    }

}