<?php

class QuestionNumberController extends BaseController
{
    private $viewVars = [];
    private $filesList = [];

    function __construct()
    {
        $this->viewVars['message'] = '';
        $this->viewVars['title'] = 'Вопросы';
        $this->viewVars['statement'] = '';
        $this->viewVars['answer'] = '';
        $this->viewVars['complexity'] = 0;
        $this->viewVars['plustime'] = 0;
        $this->viewVars['description'] = '';
        $this->viewVars['link'] = '';

        $this->viewVars['categories'] = Category::all();

        //Files inputs

        for ($i = 1; $i <= 5; $i++) {
            $this->filesList['file' . $i] = '';
        }

        $this->viewVars['filesView'] = View::make('admin.questions.filesUpload', $this->filesList);

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

        $this->viewVars['questions'] = QuestionNumber::all();
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

        $this->viewVars['questions'] = QuestionNumber::all();
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
                $this->viewVars['questions'] = QuestionNumber::all();
                return View::make('admin.questions.addQuestionNumbers', $this->viewVars);

            } else {
                $this->viewVars['message'] = 'УУУпс. Ошибонька.';
                $this->viewVars['questions'] = QuestionNumber::all();
                return View::make('admin.questions.addQuestionNumbers', $this->viewVars);
            }
        }

        $this->viewVars['questions'] = QuestionNumber::all();
        return View::make('admin.questions.delQuestionNumbers', $this->viewVars);
    }

    public function showFromCat($id)
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
    }


    


    /*-------------------------------------------------
    HELPER FUNCTIONS
    --------------------------------------------------*/


    function setViewVarsByInput()
    {
        $this->viewVars['message'] = 'Корректно заполните все поля!';
        $this->viewVars['statement'] = Input::get('statement');
        $this->viewVars['answer'] = Input::get('answer');
        $this->viewVars['complexity'] = Input::get('complexity');
        $this->viewVars['category'] = Input::get('category');
        $this->viewVars['plustime'] = Input::get('plustime');
        $this->viewVars['description'] = Input::get('description');
        $this->viewVars['link'] = Input::get('link');

        //Files inputs

        for ($i = 1; $i <= 5; $i++) {
            $this->filesList['file' . $i] = Input::get('file' . $i);
        }

        $this->viewVars['filesView'] = View::make('admin.questions.filesUpload', $this->filesList);
    }

    function setViewVarsByQ($q)
    {
        $this->viewVars['statement'] = $q->statement;
        $this->viewVars['answer'] = $q->answer;
        $this->viewVars['complexity'] = $q->complexity;
        $this->viewVars['plustime'] = $q->plustime;
        $this->viewVars['category'] = $q->category;
        $this->viewVars['description'] = $q->description;
        $this->viewVars['id'] = $q->id;
        $this->viewVars['link'] = $q->link;

        $this->setFilesByQ($q);
    }

    function getFilesByInput($q = NULL)
    {
        $i = 1;
        if ($q === NULL) {
            $files = [];
        } else {
            $files = json_decode($q->files, true);
        }

        echo Input::hasFile('file1');
        while ($i <= 5) {
            if (Input::hasFile('file' . $i)) {
                $filename = time() . $i . 'jpg';
                $upload_success = Input::file('file' . $i)->move(public_path() . "/game_img/", $filename);
                if ($upload_success) {
                    $files[$i] = '/game_img/' . $filename;
                } else {
                    echo Input::file('file' . $i)->getRealPath();
                }
                //$files[$i] = '/game_img/'.$filename;
            }
            $i++;
        }
        return json_encode($files);
    }

    function setFilesByQ($q)
    {
        if ($q->files != '') {
            $files = json_decode($q->files);
            foreach ($files as $i => $f) {
                $this->filesList['file' . $i] = $f;
            }
            $this->viewVars['filesView'] = View::make('admin.questions.filesUpload', $this->filesList);
        }
    }
}
