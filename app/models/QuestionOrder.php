<?php

class QuestionOrder extends Eloquent
{
    use QuestionModelTrait;
    
    protected $table = 'q_order';
    public $timestamps = false; //delete updated_at and created_at properties

    public function add($statement, $complexity, $category, $plustime, $description, $link, $files, $tests){
        if($statement == '' || strlen( $statement ) < 5){
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
        $this->complexity = $complexity;
        $this->category = $category;
        $this->plustime = $plustime;
        $this->description = $description;
        $this->link = $link;
        $this->files = $files;
        $this->tests = $tests;
        $this->save();
        return 1;
    }
    public function edit($statement, $complexity, $category, $plustime, $description, $link, $files, $tests){
        if($statement == '' || strlen( $statement ) < 5){
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
        $this->complexity = $complexity;
        $this->category = $category;
        $this->plustime = $plustime;
        $this->description = $description;
        $this->link = $link;
        $this->files = $files;
        $this->tests = $tests;
        $this->save();
        return 1;
    }

}