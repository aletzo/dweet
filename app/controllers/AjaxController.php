<?php

/**
 * this is the base class that extend all the controllers that are used in AJAX calls
 */
class AjaxController
{
    
    /**
     * returns the requested parameter from the $_POST array
     * 
     * @param string $name the name of the parameter
     * @param mixed $default [optional] what to return if the requested parameter was not found
     * @return mixed the requested parameter if found, the $default otherwise
     */
    protected function getPostParameter($name, $default = null)
    {
        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }

}
