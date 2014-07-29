<?php

class QuestionMap extends Eloquent
{
    use QuestionModelTrait;
    
    protected $table = 'q_maps';
    public $timestamps = false; //delete updated_at and created_at properties

    public function edit($statement, $answer, $complexity, $category, $plustime, $description, $link, $files, $map, $error){
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
        if($map == '' ){
            return 0;
        }
        if($error == '' || !is_numeric($error) || $error < 0 || $error > 300 ){
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
        $this->map = $map;
        $this->error = $error;
        $this->save();
        return 1;
    }

}