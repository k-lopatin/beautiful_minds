<?php

class CitiesController extends BaseController
{
    use QuestionTrait;

    private $viewVars = [];
    private $filesList = [];

    private $model = 'City';

    function __construct(){
        if( !UserLibrary::loginAdmin() ){
            exit();
        }
        $this->setViewVarsStandart();
        $this->viewVars['typeTitle'] = 'города';
    }

    public function add()
    {
        if (Input::has('name')) {
            $q = new City;
            if ( $q->add( Input::get('name'), Input::get('country'), Input::get('population'),
                Input::get('description'), $this->getFilesByInput())
                ) {

                $this->viewVars['message'] = 'Город успешно добавлен!';
                $model = $this->model;
                $is_free=0;
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
            } else {
                $this->setViewVarsByInput();
            }
        }

        $this->viewVars['questions'] = City::orderBy('id', 'desc')->take(10)->get();
        return View::make('admin.questions.addCities', $this->viewVars);
    }

    public function edit($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $q = City::find($id);

        if (Input::has('name')) {
            if ( $q->add( Input::get('name'), Input::get('country'), Input::get('population'),
                Input::get('description'), $this->getFilesByInput())
                ) {

                $this->viewVars['message'] = 'Город успешно отредактирован!';
                $model = $this->model;
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
            } else {
                $this->setViewVarsByInput();
            }
        }

        $this->setViewVarsByQ($q);

        $this->viewVars['questions'] = City::orderBy('id', 'desc')->take(10)->get();
        return View::make('admin.questions.editCities', $this->viewVars);
    }

    public function delete($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $q = City::find($id);
        $this->viewVars['statement'] = $q->statement;
        $this->viewVars['id'] = $q->id;

        $model = $this->model;
        if (Input::has('is') && Input::get('is') == 1) {
            if ( $q->delete() ) {
                $this->viewVars['message'] = 'Город успешно удален!';
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
                return View::make('admin.questions.addCities', $this->viewVars);

            } else {
                $this->viewVars['message'] = 'УУУпс. Ошибонька.';
                $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
                return View::make('admin.questions.addCities',$this->viewVars);
            }
        }

        $this->viewVars['questions'] = City::all();
        return View::make('admin.questions.delCities', $this->viewVars);
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
