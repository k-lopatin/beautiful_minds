<?php

class AdditionalController extends BaseController
{
    private $viewVars = [];

    function __construct(){
        if( !UserLibrary::loginAdmin() ){
            exit();
        }
        $this->viewVars['headerTpl'] = View::make('admin.header', array('title' => 'Дополнительные функции'));
        $this->viewVars['footerTpl'] = View::make('admin.footer');

        $this->viewVars['message'] = '';
    }

    public function showAdditional()
    {       
        if( Input::has('model') ){
            foreach (Input::get('model') as $m) {
                if( $m::updateIndex() ){
                    $this->viewVars['message'] .= 'Индекс вопросов '.$m.' обновлен успешно <br />';
                }
            }
        }

        return View::make('admin.additional', $this->viewVars);
    }



    /*-------------------------------------------------
        HELPER FUNCTIONS
        --------------------------------------------------*/

}
