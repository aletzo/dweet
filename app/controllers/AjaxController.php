<?php

class AjaxController
{
    protected function getPostParameter($name, $default = null)
    {
        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }

}
