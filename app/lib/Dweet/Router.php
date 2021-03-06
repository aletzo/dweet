<?php

/**
 * the class that decides with controller/action combo to fetch
 */
class Dweet_Router
{
    
    static protected $instance = null;

    /**
     * a singleton pattern
     * 
     * @return Dweet_Router 
     */
    static public function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * this method decides (resolves) which controller/action combo to fetch
     */
    static public function resolve()
    {
        $projectDir = basename(PROJECT_ROOT);

        $params = explode('/' ,$_SERVER['REQUEST_URI']);

        /*
         * by using the default_controller and the default_action configuration parameters
         * we achieve this:
         * 
         * http://localhost/dweet
         * http://localhost/dweet/page
         * http://localhost/dweet/page/home
         * 
         * all the three routes above resolve to the same page
         */
        $defaultController = Dweet::getInstance()->config['default_controller'];
        $defaultAction     = Dweet::getInstance()->config['default_action'];

        /* the route is supposed to be http://localhost/dweet/:controller/:action with out virtual host e.g. http://localhost/dweet/page/about
         * and http://dweet.local/:controller/:action with virtual host e.g. http://dweet.local/page/about
         */

        if (in_array($projectDir, $params)) { // the site is viewed without virtual host (e.g. http://localhost/dweet ) so we want to skip the 'dweet' part
            $controller = isset($params[2]) && ! empty($params[2]) ? $params[2] : $defaultController;
            $action     = isset($params[3]) && ! empty($params[3]) ? $params[3] : $defaultAction;
        } else { //the site is viewed with virtual host (e.g. http://dweet.local )
            $controller = isset($params[1]) && ! empty($params[1]) ? $params[1] : $defaultController;
            $action     = isset($params[2]) && ! empty($params[2]) ? $params[2] : $defaultAction;
        }

        $className  = ucfirst($controller) . 'Controller';
        $methodName = strtolower($action) .'Action';

        // if the controller or the action is invalid, send the user to the defined error controller and the defined error action
        if (! class_exists($className) || ! method_exists($className, $methodName)) { 
            $className  = ucfirst(Dweet::getInstance()->config['error_controller']) . 'Controller';
            $methodName = strtolower(Dweet::getInstance()->config['error_action']) . 'Action';
        }

        $class = new $className;

        $class->$methodName();
    }

}
