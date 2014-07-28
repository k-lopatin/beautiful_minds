<?php

trait QuestionTrait
{
	function setViewVarsStandart()
	{
		$this->viewVars['message'] = '';
        $this->viewVars['title'] = 'Вопросы';
        $this->viewVars['statement'] = '';
        $this->viewVars['answer'] = '';
        $this->viewVars['error'] = '10';
        $this->viewVars['complexity'] = 0;
        $this->viewVars['plustime'] = 0;
        $this->viewVars['description'] = '';
        $this->viewVars['link'] = '';
        $this->viewVars['map'] = '';

        $this->viewVars['categories'] = Category::all();

        //Files inputs

        for ($i = 1; $i <= 5; $i++) {
            $this->filesList['file' . $i] = '';
        }

        $this->viewVars['filesView'] = View::make('admin.questions.filesUpload', $this->filesList);
        $model = $this->model;
        $this->viewVars['questions'] = $model::orderBy('id', 'desc')->take(10)->get();
        if($model == 'QuestionTest' || $model == 'QuestionOrder')
        {
            $this->getTestAnswers();
        }
	}

    function getTestAnswers()
    {
        $testAnswers = [];
        foreach ($this->viewVars['questions'] as $q) {
            $tmp = json_decode($q->tests, true);
            $testAnswers[ $q->id ] = $tmp[1];
        }
        $this->viewVars['testAnswers'] = $testAnswers;
    }

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

        if($this->model == 'QuestionMap'){
            $this->viewVars['map'] = $q->map;
            $this->viewVars['error'] = $q->error;
        }

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
            if($files !== NULL) {
                foreach ($files as $i => $f) {
                    $this->filesList['file' . $i] = $f;
                }
            }
            $this->viewVars['filesView'] = View::make('admin.questions.filesUpload', $this->filesList);
        }
    }

    function getMapImgs()
    {
        $files = File::files(public_path() . '/map_img');
        foreach($files as $i => $f){
            $t = str_replace(public_path(), '', $f);
            $files[ $i ] = $t;
        }
        return $files;
    }
}

