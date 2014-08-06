<?php

class IndexController extends BaseController
{
    private $viewVars = [];

    function __construct(){


    }

    public function index()
    {
        $c = CityLibrary::getRandomFreeCity();
        $this->viewVars['random_city'] = $c->name;
        return View::make('frontend.index', $this->viewVars);
    }



    /*-------------------------------------------------
        HELPER FUNCTIONS
        --------------------------------------------------*/


}
