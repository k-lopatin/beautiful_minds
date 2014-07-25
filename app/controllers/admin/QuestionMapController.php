<?php

class QuestionMapController extends BaseController
{
    use QuestionTrait;

    private $viewVars = [];
    private $filesList = [];

    private $model = 'QuestionMap';

    function __construct(){
        if( !UserLibrary::loginAdmin() ){
            exit();
        }
        $this->setViewVarsStandart();
        $this->viewVars['mapImgs'] = $this->getMapImgs();
        $this->viewVars['typeTitle'] = 'карта';

    }

    public function add()
    {
        $model = $this->model;
        $this->viewVars['mode'] = 'add';

        if (Input::has('statement')) {
            $q = new QuestionMap;
            if ( $q->edit( Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link'),
                $this->getFilesByInput(), Input::get('map'), Input::get('error'))
                ) {

                $this->viewVars['message'] = 'Вопрос успешно добавлен!';
                $model = $this->model;
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
            } else {
                $this->setViewVarsByInput();
            }
        }

        return View::make('admin.questions.editQuestionMap', $this->viewVars);
    }

    public function edit($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }

        $model = $this->model;
        $this->viewVars['mode'] = 'edit';

        $q = $model::find($id);

        if (Input::has('statement')) {
            if ($q->edit(Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link'),
                $this->getFilesByInput($q), Input::get('map'), Input::get('error'))
            ) {
                $this->viewVars['message'] = 'Вопрос успешно отредактирован!';
                $model = $this->model;
            } else {
                $this->setViewVarsByInput();
            }
        }

        $this->setViewVarsByQ($q);

        $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
        return View::make('admin.questions.editQuestionMap', $this->viewVars);
    }

    public function delete($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $model = $this->model;
        $this->viewVars['mode'] = 'del';

        $q = $model::find($id);
        $this->viewVars['statement'] = $q->statement;
        $this->viewVars['id'] = $q->id;

        $model = $this->model;
        if (Input::has('is') && Input::get('is') == 1) {
            if ( $q->delete() ) {
                $this->viewVars['message'] = 'Вопрос успешно удален!';
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
                $this->viewVars['mode'] = 'add';
                return View::make('admin.questions.editQuestionMap', $this->viewVars);

            } else {
                $this->viewVars['message'] = 'УУУпс. Ошибонька.';
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
                $this->viewVars['mode'] = 'add';
                return View::make('admin.questions.editQuestionMap',$this->viewVars);
            }
        }

        $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
        return View::make('admin.questions.editQuestionMap', $this->viewVars);
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
