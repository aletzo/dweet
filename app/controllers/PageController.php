<?php

require_once PROJECT_ROOT . '/app/controllers/BaseController.php';

/**
 * the default controller that displays pages
 */
class PageController extends BaseController
{
    
    /**
     * the default action that draws the requested functionality (twitter clone)
     */
    public function homeAction()
    {
        if (isset($_SESSION['user_id'])) {
            $user = UserTable::load($_SESSION['user_id']);
        }
        
        if ( ! $user) {
            $user = new User();
            $user->name = 'Alex';
            $user->save();
            
            $_SESSION['user_id'] = $user->id;
        }

        $this->render('page/home', array('user' => $user));
    }

    /**
     * a simple about page
     */
    public function aboutAction()
    {
        $this->render('page/about');
    }

}

