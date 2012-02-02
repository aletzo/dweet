<?php

require_once PROJECT_ROOT . '/app/controllers/BaseController.php';

class ErrorController extends BaseController
{
    
    public function notfoundAction()
    {
    
        return $this->render('error/notfound');
    }

}

