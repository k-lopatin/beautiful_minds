<?php

class RandomQuestionController extends BaseController
{
    function __construct(){
        
    }

    public function showRandom($model)
    {       
       $n = $model::count();
       $randomIndex = mt_rand(1, $n);
       $q = $model::Where( 'index', '=', $randomIndex)->firstOrFail();
       echo $q->statement.'<br>';
       $c = Category::find($q->category);
       echo $c->name.'<br>';
       echo $q->complexity;

    }



    /*-------------------------------------------------
        HELPER FUNCTIONS
        --------------------------------------------------*/

}
