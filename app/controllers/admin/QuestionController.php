<?php

class QuestionController extends BaseController
{
    private $viewVars = [];
    private $q_per_page;

    function __construct(){
        if( !UserLibrary::loginAdmin() ){
            exit();
        }
        $this->viewVars['message'] = '';
        $this->viewVars['title'] = 'Вопросы';


        $this->viewVars['typeTitle'] = '';
        $this->viewVars['categories'] = Category::all();

        $catNames[0] = 'Без категории';


        foreach ($this->viewVars['categories'] as $c) {
            $catNames[ $c->id ] = $c->name;
        }
        $this->viewVars['catNamesById'] = $catNames;

        for ($i = 1; $i <= 5; $i++) {
            $this->filesList['file' . $i] = '';
        }
         for ($i = 1; $i <= 5; $i++) {
            $this->testsList['test' . $i] = '';
         }

        $this->viewVars['filesView'] = View::make('admin.questions.filesUpload', $this->filesList);
        $this->viewVars['testsView'] = View::make('admin.questions.testsAnswersUpload', $this->testsList);
        $this->viewVars['orderView'] = View::make('admin.questions.orderAnswersUpload', $this->testsList);

        $this->viewVars['linkType'] = '';
        $this->viewVars['linkCategory'] = '';
        $this->viewVars['linkComplexity'] = '';
        $this->viewVars['linkPage'] = '';

        $this->viewVars['search'] = '';

        $this->viewVars['count'] = 0;

        $this->q_per_page = 15;

    }

    public function showList()
    {

        if (!Input::has('type')) {
            return 'error';
        }

        switch( Input::get('type') ){
            case 'number':
                $model = 'QuestionNumber';                
                $this->viewVars['typeTitle'] = 'Числа';
                $this->viewVars['linkType'] = 'number';
                $this->viewVars['linkToQ'] = 'q_numbers';
                break;
            case 'word':
                $model = 'QuestionWord';
                $this->viewVars['typeTitle'] = 'Слова';
                $this->viewVars['linkType'] = 'word';
                $this->viewVars['linkToQ'] = 'q_words';
                break;
            case 'test':
                $model = 'QuestionTest';
                $this->viewVars['typeTitle'] = 'Тесты';
                $this->viewVars['linkType'] = 'test';
                $this->viewVars['linkToQ'] = 'q_tests';
                break;
            case 'order':
                $model = 'QuestionOrder';
                $this->viewVars['typeTitle'] = 'Порядок';
                $this->viewVars['linkType'] = 'order';
                $this->viewVars['linkToQ'] = 'q_order';
                break;
            case 'map':
                $model = 'QuestionMap';
                $this->viewVars['typeTitle'] = 'Карты';
                $this->viewVars['linkType'] = 'map';
                $this->viewVars['linkToQ'] = 'q_maps';
                break;
            case 'city':
                $model = 'City';
                $this->viewVars['typeTitle'] = 'Города';
                $this->viewVars['linkType'] = 'city';
                $this->viewVars['linkToQ'] = 'cities';
                break;
            default:
                return 'error';
        }

        $questions = $model::orderBy('id', 'desc');

        $isSort = false;
        $where = '';
        $this->viewVars['count'] = $questions->count();


        if( Input::has('complexity') && Input::get('complexity') > 0 && Input::get('complexity') <=10 ){
            //$questions = $questions->where( 'complexity', '=', Input::get('complexity') );
            $where = 'complexity = '.Input::get('complexity');
            $this->viewVars['linkComplexity'] = Input::get('complexity');
            $isSort = true;
        }

        if( Input::has('category') && Input::get('category') >= 0 ){
            //$questions = $questions->where( 'category', '=', Input::get('category') );
            if($isSort) $where .= ' AND ';
            $where .= 'category = '.Input::get('category');
            $this->viewVars['linkCategory'] = Input::get('category');
            $isSort = true;
        }

        if( Input::has('s') && Input::get('s') != '' ){
            if($isSort) $where .= ' AND ';
            if($model == 'QuestionTest' || $model == 'QuestionOrder'){
                $where .= 'statement LIKE "%'.Input::get('s').'%" OR tests LIKE "%'.Input::get('s').'%"';
            } elseif ($model == 'QuestionMap') {
                $where .= 'statement LIKE "%'.Input::get('s').'%"';
            } else {
                $where .= 'statement LIKE "%'.Input::get('s').'%" OR answer LIKE "%'.Input::get('s').'%"';
            }
            $this->viewVars['search'] = Input::get('s');
            $isSort = true;
        }

        if( Input::has('page') ){
            $this->viewVars['linkPage'] = Input::get('page');
        }

        if( $isSort ){
            $questions = $questions->whereRaw( $where );
        }
        $this->viewVars['questions'] = $questions->paginate($this->q_per_page);

        return View::make('admin.questions.list', $this->viewVars);

    }



    /*-------------------------------------------------
        HELPER FUNCTIONS
        --------------------------------------------------*/


}
