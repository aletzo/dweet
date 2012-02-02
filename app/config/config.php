<?php

return array(
    'db_host'            => 'localhost',
    'db_name'            => 'dweet',
    'db_username'        => 'root',
    'db_password'        => 'root',
    'default_controller' => 'page', //if you change this, you have to create a controller similar to app/controllers/PageController
    'default_action'     => 'home', //if you change this, you have to create an action similar to app/controllers/PageController::homeAction()
    'default_layout'     => 'default', //if you change this, you have to crate a layout file, similar to app/views/layouts/default.php
    'error_controller'   => 'error', //if you change this, you have to create a controller similar to app/controllers/ErrorController
    'error_action'       => 'notfound' //if you change this, you have to create an action similar to app/controllers/ErrorController::notfoundAction()
);
