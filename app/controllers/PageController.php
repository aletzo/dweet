<?php

require_once PROJECT_ROOT . '/app/controllers/BaseController.php';

class PageController extends BaseController
{
    
    public function homeAction()
    {
        if (isset($_SESSION['user_id'])) {
            $user = UserTable::load($_SESSION['user_id']);
        }

        if ( ! $user) {
            $user = new User();
            $user->name = 'Alex';
            $user->save();
        }

        $_SESSION['user_id'] = $user->id;

        return $this->render('page/home', array('user' => $user));
    }

    public function aboutAction()
    {
        return $this->render('page/about');
    }

}

