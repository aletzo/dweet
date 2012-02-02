<?php

return array(
    'db_host'            => 'localhost', // set this to your server name
    'db_name'            => 'dweet',     // set this to your database name
    'db_username'        => 'root',      // set this to your database username
    'db_password'        => 'root',      // set this to your database password
    'default_controller' => 'page',      // if you change this, you have to create a controller similar to app/controllers/PageController
    'default_action'     => 'home',      // if you change this, you have to create an action similar to app/controllers/PageController::homeAction()
    'default_layout'     => 'default',   // if you change this, you have to crate a layout file, similar to app/views/layouts/default.php
    'error_controller'   => 'error',     // if you change this, you have to create a controller similar to app/controllers/ErrorController
    'error_action'       => 'notfound'   // if you change this, you have to create an action similar to app/controllers/ErrorController::notfoundAction()
);
