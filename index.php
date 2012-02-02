<?php

error_reporting(E_ALL);

session_id('dweet-session');
session_start();

define ('PROJECT_ROOT', dirname(__FILE__));

require_once 'app/lib/Dweet.php';

Dweet::getInstance()->initialize();

