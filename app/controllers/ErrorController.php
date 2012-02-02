<?php

require_once PROJECT_ROOT . '/app/controllers/BaseController.php';

/**
 * the controller that handles the errors
 */
class ErrorController extends BaseController
{
    
    /**
     * the action that draws the 404 not found error page
     */
    public function notfoundAction()
    {
        $this->render('error/notfound');
    }

}

