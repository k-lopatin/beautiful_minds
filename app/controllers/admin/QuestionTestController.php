<?php

class QuestionTestController extends BaseController
{
    private $viewVars = [];
    private $filesList = [];
    private $testsList = [];

    function __construct(){
        if( !UserLibrary::loginAdmin() ){
            exit();
        }
        $this->viewVars['message'] = '';
        $this->viewVars['title'] = 'Вопросы';
        $this->viewVars['statement'] = '';
        $this->viewVars['answer'] = '';
        $this->viewVars['complexity'] = 0;
        $this->viewVars['plustime'] = 0;
        $this->viewVars['description'] = '';
        $this->viewVars['link'] = '';

        $this->viewVars['typeTitle'] = 'тесты';
        $this->viewVars['categories'] = Category::all();

        for ($i = 1; $i <= 5; $i++) {
            $this->filesList['file' . $i] = '';
        }
        for ($i = 1; $i <= 5; $i++) {
            $this->testsList['test' . $i] = '';
        }

        $this->viewVars['filesView'] = View::make('admin.questions.filesUpload', $this->filesList);
        $this->viewVars['testsView'] = View::make('admin.questions.testsAnswersUpload', $this->testsList);

    }

    public function add()
    {

        if (Input::has('statement')) {
            $q = new QuestionTest;
            $count=0;
            $i=0;
            while ($i <= 5) {
                if (Input::has('test' . $i)) {
                    $tests[$i] = Input::get('test' . $i);
                    } else {
                        // echo Input::get('test' . $i);
                        echo $count++;;
                        //$count++;
                    }
                $i++;
            }
            if($count>4)
                $this->setViewVarsByInput();
            else
            {
                if ( $q->add( Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                    Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link'),
                    $this->getFilesByInput(), $this->getTestsByInput())
                    ) {

                    $this->viewVars['message'] = 'Вопрос успешно добавлен!';
                } else {
                    $this->setViewVarsByInput();
                }
            }
        }
        $this->viewVars['questions'] = QuestionTest::all();
        return View::make('admin.questions.addQuestionTests', $this->viewVars);
    }

    public function edit($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $q = QuestionTest::find($id);
        $count=0;
        $i=0;
        while ($i <= 5) {
            if (Input::has('test' . $i)) {
                $tests[$i] = Input::get('test' . $i);
                } else {
                    // echo Input::get('test' . $i);
                    echo $count++;;
                    //$count++;
                }
            $i++;
        }
        if($count>4)
            $this->setViewVarsByInput();
        else
        {
            if (Input::has('statement')) {
                if ($q->edit(Input::get('statement'), Input::get('answer'), Input::get('complexity'),
                    Input::get('category'), Input::get('plustime'), Input::get('description'), Input::get('link'),
                    $this->getFilesByInput($q), $this->getTestsByInput())
                ) {

                    $this->viewVars['message'] = 'Вопрос успешно отредактирован!';
                } else {
                    $this->setViewVarsByInput();
                }
            }
        }
        $this->setViewVarsByQ($q);

        $this->viewVars['questions'] = QuestionTest::all();
        return View::make('admin.questions.editQuestionTests', $this->viewVars);
    }

    public function delete($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $q = QuestionTest::find($id);
        $this->viewVars['statement'] = $q->statement;
        $this->viewVars['id'] = $q->id;


        if (Input::has('is') && Input::get('is') == 1) {
            if ( $q->delete() ) {
                $this->viewVars['message'] = 'Вопрос успешно удален!';
                $this->viewVars['questions'] = QuestionTest::all();
                return View::make('admin.questions.addQuestionTests', $this->viewVars);

            } else {
                $this->viewVars['message'] = 'УУУпс. Ошибонька.';
                $this->viewVars['questions'] = QuestionTest::all();
                return View::make('admin.questions.addQuestionTests',$this->viewVars);
            }
        }

        $this->viewVars['questions'] = QuestionTest::all();
        return View::make('admin.questions.delQuestionTests', $this->viewVars);
    }

    public function showFromCat($id)
    {
        if ( !is_numeric($id) ) {
            return 'error';
        }
        $q = QuestionTest::where('category', '=', $id)->get();
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

            // Text inputs

            for ($i = 1; $i <= 5; $i++) {
                $this->testsList['test' . $i] = Input::get('test' . $i);
            }
            $this->viewVars['testsView'] = View::make('admin.questions.testsAnswersUpload', $this->testsList);
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
            $this->setTestsByQ($q);
        }

        function getTestsByInput($q = NULL)
        {
            $i = 1;
            if ($q === NULL) {
                $tests = [];
            } else {
                $tests = json_decode($q->tests, true);
            }

           // echo Input::has('test1');
            while ($i <= 5) {
                if (Input::has('test' . $i)) {
                    $tests[$i] = Input::get('test' . $i);
                    } else {
                       echo Input::get('test' . $i);
                       //$count++;
                    }
                    $i++;
                }
            return json_encode($tests);
        }
        function setTestsByQ($q)
        {
            if ($q->tests != '') {
                $tests = json_decode($q->tests);
                if($tests !== NULL) {
                    foreach ($tests as $i => $t) {
                        $this->testsList['test' . $i] = $t;
                    }
                }
                $this->viewVars['testsView'] = View::make('admin.questions.testsAnswersUpload', $this->testsList);
            }
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
                if($files !== NULL) {
                    foreach ($files as $i => $f) {
                        $this->filesList['file' . $i] = $f;
                    }
                }
                $this->viewVars['filesView'] = View::make('admin.questions.filesUpload', $this->filesList);
            }
        }
}
