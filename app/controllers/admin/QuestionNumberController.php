<?php

class QuestionNumberController extends BaseController
{
    use QuestionTrait;

    private $viewVars = [];
    private $filesList = [];

    private $model = 'QuestionNumber';

    function __construct()
    {
        if( !UserLibrary::loginAdmin() ){
            exit();
        }
        $this->setViewVarsStandart();
        $this->viewVars['typeTitle'] = 'числа';
    }

    public function add()
    {

        if (Input::has('statement')) {
            $q = new QuestionNumber;
            if ($q->edit(Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link'),
                $this->getFilesByInput())
            ) {

                $this->viewVars['message'] = 'Вопрос успешно добавлен!';
            } else {
                $this->setViewVarsByInput();
            }
        }

        return View::make('admin.questions.addQuestionNumbers', $this->viewVars);
    }

    public function edit($id)
    {
        if (!is_numeric($id)) {
            return 'error';
        }
        $q = QuestionNumber::find($id);


        if (Input::has('statement')) {
            if ($q->edit(Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link'),
                $this->getFilesByInput($q))
            ) {

                $this->viewVars['message'] = 'Вопрос успешно отредактирован!';
            } else {
                $this->setViewVarsByInput();
            }
        }

        $this->setViewVarsByQ($q);

        return View::make('admin.questions.editQuestionNumbers', $this->viewVars);
    }

    public function delete($id)
    {
        if (!is_numeric($id)) {
            return 'error';
        }
        $q = QuestionNumber::find($id);
        $this->viewVars['statement'] = $q->statement;
        $this->viewVars['id'] = $q->id;


        if (Input::has('is') && Input::get('is') == 1) {
            if ($q->delete()) {
                $this->viewVars['message'] = 'Вопрос успешно удален!';
                return View::make('admin.questions.addQuestionNumbers', $this->viewVars);

            } else {
                $this->viewVars['message'] = 'УУУпс. Ошибонька.';
                return View::make('admin.questions.addQuestionNumbers', $this->viewVars);
            }
        }

        return View::make('admin.questions.delQuestionNumbers', $this->viewVars);
    }

    /*public function showFromCat($id)
    {
        if (!is_numeric($id)) {
            return 'error';
        }
        $q = QuestionNumber::where('category', '=', $id)->get();
        $cat = Category::find($id);
        $this->viewVars['cur_id'] = $id;
        if ($id != 0) {
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
