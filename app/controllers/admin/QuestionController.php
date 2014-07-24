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

        $this->viewVars['linkType'] = '';
        $this->viewVars['linkCategory'] = '';
        $this->viewVars['linkComplexity'] = '';
        $this->viewVars['linkPage'] = '';

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
                $questions = QuestionNumber::orderBy('id', 'desc');
                $this->viewVars['typeTitle'] = 'Числа';
                $this->viewVars['linkType'] = 'number';
                $this->viewVars['linkToQ'] = 'q_numbers';
                break;
            case 'word':
                $questions = QuestionWord::orderBy('id', 'desc');
                $this->viewVars['typeTitle'] = 'Слова';
                $this->viewVars['linkType'] = 'word';
                $this->viewVars['linkToQ'] = 'q_words';
                break;
            case 'test':
                $questions = QuestionTest::orderBy('id', 'desc');
                $this->viewVars['typeTitle'] = 'Тесты';
                $this->viewVars['linkType'] = 'test';
                $this->viewVars['linkToQ'] = 'q_tests';
                break;
            default:
                return 'error';
        }
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
