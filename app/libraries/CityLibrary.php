<?php

class CityLibrary extends Eloquent
{
    use QuestionModelTrait;

    function __construct(){

    }
    public static function getRandomFreeCity()
    {
        $model = 'City';
        echo '<ul>';
        $c = self::getRandomCity($model, $model::count()); //@todo cache count results
        if($c !== NULL){
            echo '<li>'.$c->name.'</li>';
        } else {
            echo "ERROR!";
        }
    }
    public static function getRandomCity($model, $maxN)
    {
        $check = 0;
        $cities = City::all();
        foreach($cities as $c){
            if($c->index!=0)
                $check=1;
        }
        if($check == 0){
            return NULL;
        } else {
            $isInf = 0;
            while($isInf < 100){
                $randomIndex = mt_rand(1, $maxN);
                $c = $model::Where( 'index', '=', $randomIndex)->firstOrFail();
                if($c->is_free == 0){
                    return $c;
                }
            }
        }
        return NULL;
    }
}