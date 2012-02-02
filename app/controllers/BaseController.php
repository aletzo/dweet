<?php

/**
 * this is the base class that extend all the controllers that their actions render a view
 */
class BaseController
{
    
    /**
     * prepares the view to be rendered in the layout
     * 
     * @param string $view the controller/action combo that corresponds to a view file in app/views
     * @param array $params [optional] any parameters/variables that the user wishes to pass to the layout
     * @param string $layout [optional] the layout to draw the view inside
     */
    protected function render($view, $params = array(), $layout = null)
    {
        $viewFile = PROJECT_ROOT . '/app/views/' . $view . '.php';

        if (is_file($viewFile)) {
            $this->renderLayout($viewFile, $params, $layout);
        }
    }

    /**
     * renders the layout along with the view
     * 
     * @param string $action the path to view file
     * @param array $params the parameters/variables that the user wishes to pass to the layout
     * @param type $layout the layout to draw the view inside
     */
    protected function renderLayout($action, $params, $layout)
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

}
