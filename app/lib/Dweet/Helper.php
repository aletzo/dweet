<?php

class Dweet_Helper
{

    static public function baseurl()
    {
        //a solution that works both with virtual host (e.g. http://dweet.local) and without (e.g. http://localhost/dweet)
        return 'http://' . $_SERVER['HTTP_HOST'] . str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
    }

}

