<?php

class QuestionWordController extends BaseController
{
    private $viewVars = [];
    function __construct(){
        $this->viewVars['message'] = '';
        $this->viewVars['title'] = 'Вопросы';
        $this->viewVars['statement'] = '';
        $this->viewVars['answer'] = '';
        $this->viewVars['complexity'] = 0;
        $this->viewVars['plustime'] = 0;
        $this->viewVars['description'] = '';
        $this->viewVars['link'] = '';
        $this->viewVars['typeTitle'] = 'слова';


        $this->viewVars['categories'] = Category::all();
    }

    public function add()
    {

        if (Input::has('statement')) {
            $q = new QuestionWord;
            if ( $q->add( Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link') ) ) {

                $this->viewVars['message'] = 'Вопрос успешно добавлен!';
            } else {
                $this->viewVars['message'] = 'Корректно заполните все поля!';
                $this->viewVars['statement'] = Input::get('statement');
                $this->viewVars['answer'] = Input::get('answer');
                $this->viewVars['complexity'] = Input::get('complexity');
                $this->viewVars['category'] = Input::get('category');
                $this->viewVars['plustime'] = Input::get('plustime');
                $this->viewVars['description'] = Input::get('description');
                $this->viewVars['link'] = Input::get('link');
            }
        }

        $this->viewVars['questions'] = QuestionWord::all();
        return View::make('admin.questions.addQuestionWords', $this->viewVars);
    }

    public function edit($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $q = QuestionWord::find($id);

        if (Input::has('statement')) {
            if ( $q->edit( Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link') ) ) {

                $this->viewVars['message'] = 'Вопрос успешно отредактирован!';
            } else {
                $this->viewVars['message'] = 'Корректно заполните все поля!';
                $this->viewVars['statement'] = Input::get('statement');
                $this->viewVars['answer'] = Input::get('answer');
                $this->viewVars['complexity'] = Input::get('complexity');
                $this->viewVars['category'] = Input::get('category');
                $this->viewVars['plustime'] = Input::get('plustime');
                $this->viewVars['description'] = Input::get('description');
                $this->viewVars['link'] = Input::get('link');
            }
        }

        $this->viewVars['statement'] = $q->statement;
        $this->viewVars['answer'] = $q->answer;
        $this->viewVars['complexity'] = $q->complexity;
        $this->viewVars['plustime'] = $q->plustime;
        $this->viewVars['category'] = $q->category;
        $this->viewVars['description'] = $q->description;
        $this->viewVars['id'] = $q->id;
        $this->viewVars['link'] = $q->link;

        $this->viewVars['questions'] = QuestionWord::all();
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


        if (Input::has('is') && Input::get('is') == 1) {
            if ( $q->delete() ) {
                $this->viewVars['message'] = 'Вопрос успешно удален!';
                $this->viewVars['questions'] = QuestionWord::all();
                return View::make('admin.questions.addQuestionWords', $this->viewVars);

            } else {
                $this->viewVars['message'] = 'УУУпс. Ошибонька.';
                $this->viewVars['questions'] = QuestionWord::all();
                return View::make('admin.questions.addQuestionWords',$this->viewVars);
            }
        }

        $this->viewVars['questions'] = QuestionWord::all();
        return View::make('admin.questions.delQuestionWords', $this->viewVars);
    }

    public function showFromCat($id)
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
    }

}
