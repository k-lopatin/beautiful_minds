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


    public function getGame()
    {
        echo '<h2>Тесты</h2>';
        $this->getQuestionsForGame( 'QuestionTest', Config::get('game.game_test_n') );

        echo '<h2>На порядок</h2>';
        $this->getQuestionsForGame( 'QuestionOrder', Config::get('game.game_order_n') );

        echo '<h2>На число</h2>';
        $this->getQuestionsForGame( 'QuestionNumber', Config::get('game.game_number_n') );

        echo '<h2>На слово</h2>';
        $this->getQuestionsForGame( 'QuestionWord', Config::get('game.game_word_n') );

        echo '<h2>На карту</h2>';
        $this->getQuestionsForGame( 'QuestionMap', Config::get('game.game_map_n') );

        echo '<h2> Город </h2>';
        CityLibrary::getRandomFreeCity();


    }
    private function getQuestionsForGame($model, $n)
    {
        echo '<ul>';
        $used = [];
        for($i=0; $i<$n; $i++){
            $q = $this->getRandomQuestion($model, $model::count(), $used); //@todo cache count results
            $used[] = $q->index;
            if($q !== NULL){
                echo '<li>'.$q->statement.'</li>';
            } else {
                echo "ERROR!";
            }
        }
        echo '</ul>';
    }
    private function getRandomQuestion($model, $maxN, $used = NULL)
    {
        $isInf = 0;
        while($isInf < 100){
            $randomIndex = mt_rand(1, $maxN);
            if( $used == NULL || !in_array( $randomIndex, $used ) ){
                $q = $model::Where( 'index', '=', $randomIndex)->firstOrFail();
                return $q;
            }
        }
        return NULL;
    }

    /*-------------------------------------------------
        HELPER FUNCTIONS
        --------------------------------------------------*/

}
