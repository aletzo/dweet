<?php

class BaseController
{

    protected function render($view, $params = array(), $layout = null)
    {
        $viewFile = PROJECT_ROOT . '/app/views/' . $view . '.php';

        if (is_file($viewFile)) {
            $this->renderLayout($viewFile, $params, $layout);
        }
    }

    protected function renderLayout($action, $params, $layout = null)
    {
        if ( ! $layout) {
            $layout = Dweet::getInstance()->config['default_layout'];
        }

        extract($params);
        
        ob_start();
        require_once $action;
        $content = ob_get_contents();
        ob_end_clean();

        $layoutFile = PROJECT_ROOT . '/app/views/layouts/' . $layout . '.php';

        ob_start();
        require_once $layoutFile;
        $html = ob_get_contents();
        ob_end_clean();

        echo $html;
    }

    protected function redirect($url)
    {
        if ( ! strstr('http://', $url)) { //if the url is not absolute, it is internal so we prepend the baseurl
            $url = Dweet_Helper::baseurl() . '/' .  trim($url, '/');
        }
        
        header('location: ' . $url);
    }



}
