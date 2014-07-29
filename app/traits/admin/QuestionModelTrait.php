<?php

trait QuestionModelTrait
{
	public static function updateIndex()
    {
        $questions = self::all();
        $i = 1;
        foreach($questions as $q){
            $q->index = $i;
            $q->save();
            $i++;
        }
        return true;
    }
}

