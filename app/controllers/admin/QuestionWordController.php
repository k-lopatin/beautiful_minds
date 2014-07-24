<?php

class QuestionWordController extends BaseController
{
    use QuestionTrait;

    private $viewVars = [];
    private $filesList = [];

    private $model = 'QuestionWord';

    function __construct(){
        if( !UserLibrary::loginAdmin() ){
            exit();
        }
        $this->setViewVarsStandart();
        $this->viewVars['typeTitle'] = 'слова';

    }

    public function add()
    {

        if (Input::has('statement')) {
            $q = new QuestionWord;
            if ( $q->add( Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link'),
                $this->getFilesByInput())
                ) {

                $this->viewVars['message'] = 'Вопрос успешно добавлен!';
                $model = $this->model;
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
            } else {
                $this->setViewVarsByInput();
            }
        }

        $this->viewVars['questions'] = QuestionWord::orderBy('id', 'desc')->take(10)->get();
        return View::make('admin.questions.addQuestionWords', $this->viewVars);
    }

    public function edit($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $q = QuestionWord::find($id);

        if (Input::has('statement')) {
            if ($q->edit(Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link'),
                $this->getFilesByInput($q))
            ) {
                $this->viewVars['message'] = 'Вопрос успешно отредактирован!';
                $model = $this->model;
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
            } else {
                $this->setViewVarsByInput();
            }
        }

        $this->setViewVarsByQ($q);

        $this->viewVars['questions'] = QuestionWord::orderBy('id', 'desc')->take(10)->get();
        return View::make('admin.questions.editQuestionWords', $this->viewVars);
    }

    public function delete($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $q = QuestionWord::find($id);
        $this->viewVars['statement'] = $q->statement;
        $this->viewVars['id'] = $q->id;

        $model = $this->model;
        if (Input::has('is') && Input::get('is') == 1) {
            if ( $q->delete() ) {
                $this->viewVars['message'] = 'Вопрос успешно удален!';
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
                return View::make('admin.questions.addQuestionWords', $this->viewVars);

            } else {
                $this->viewVars['message'] = 'УУУпс. Ошибонька.';
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
                return View::make('admin.questions.addQuestionWords',$this->viewVars);
            }
        }

        $this->viewVars['questions'] = QuestionWord::all();
        return View::make('admin.questions.delQuestionWords', $this->viewVars);
    }

    /*public function showFromCat($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $q = QuestionWord::where('category', '=', $id)->get();
        $cat = Category::find($id);
        $this->viewVars['cur_id'] = $id;
        if($id != 0){
            $this->viewVars['catName'] = $cat->name;
        } else {
            $this->viewVars['catName'] = 'Без категории';
        }


        $this->viewVars['questions'] = $q;
        return View::make('admin.questions.list', $this->viewVars);
    }*/

    /*-------------------------------------------------
        HELPER FUNCTIONS
        --------------------------------------------------*/



}
