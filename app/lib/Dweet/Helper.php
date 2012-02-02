<?php

/**
 * a class that contains the helper function(s)
 */
class Dweet_Helper
{

    /**
     * returns the baseurl of the site. It works both 
     * with virtual host (e.g. http://dweet.local)
     * and without (e.g. http://localhost/dweet)
     * 
     * @return string the baseurl of the site
     */
    static public function baseurl()
    {
        //the str_replace helps the solution to work both with virtual host and without
        return 'http://' . $_SERVER['HTTP_HOST'] . str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
    }

}

