<?php

class GameController extends BaseController
{

    function __construct()
    {

    }

    public function showGame()
    {
        return View::make('game.game');
    }

    /* -------------------------------------------------
      HELPER FUNCTIONS
      -------------------------------------------------- */
}
