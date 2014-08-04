<?php

class IndexController extends BaseController
{
    private $viewVars = [];

    function __construct(){


    }

    public function index()
    {
        return View::make('frontend.index');
    }



    /*-------------------------------------------------
        HELPER FUNCTIONS
        --------------------------------------------------*/


}
