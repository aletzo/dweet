<?php

require_once 'Dweet/Helper.php';
require_once 'Dweet/Logger.php';
require_once 'Dweet/Router.php';


require_once PROJECT_ROOT . '/app/controllers/CommentController.php';
require_once PROJECT_ROOT . '/app/controllers/ErrorController.php';
require_once PROJECT_ROOT . '/app/controllers/PageController.php';
require_once PROJECT_ROOT . '/app/controllers/PostController.php';

require_once PROJECT_ROOT . '/app/models/Comment.php';
require_once PROJECT_ROOT . '/app/models/CommentTable.php';

require_once PROJECT_ROOT . '/app/models/Post.php';
require_once PROJECT_ROOT . '/app/models/PostTable.php';

require_once PROJECT_ROOT . '/app/models/User.php';
require_once PROJECT_ROOT . '/app/models/UserTable.php';

/**
 * this class is the core of the Dweet "MVC framework".
 * It loads the configuration file, 
 * it opens the database connection
 * and it calls the Dweet_Router to resolve the url to a controller/action combo
 */
class Dweet
{
    static protected $instance = null;

    public $config = null;
    public $db     = null;

    /**
     * a singleton pattern. In a real case scenario I would prefer
     * to rename this method to init, or run or app, because it is called
     * very frequently in many files and it will help the code to be more
     * readable and it will save a few keystrokes.
     * 
     * @return Dweet
     */
    static public function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * this method calls all the required methods, so that the Dweet will be able to run properly
     */
    public function initialize()
    {
        try {
            $this->configure()
                ->initDB();


            Dweet_Router::resolve();

        } catch (Exception $e) {
            Dweet_Logger::log('error', $e->getMessage() . ' ' . $e->getTraceAsString());

            echo 'Dweet failed to initialize. Aborting...';

            die();
        }

    }

    /**
     * loads the configuration file
     * 
     * @return Dweet we return $this so that we may achieve the methods chain effect above for readability
     */
    protected function configure()
    {
        try {
            $this->config = require_once PROJECT_ROOT . '/app/config/config.php';
        } catch (Exception $e) {
            Dweet_Logger::log('error', $e->getMessage() . ' ' . $e->getTraceAsString());
        }

        return $this;
    }

    /**
     * opens the database connection. This is the first application that I do not a ready ORM framework,
     * so I prefered the PDO over the plain mysql_connent because:
     * 1. I wanted to be safe from SQL injection attacks without using the mysql_real_escape_string, 
     *    but using the PDO prepare statements
     * 2. PDO is Object Oriented and the mysql_* functions are not
     * 3. PDO is what Zend_Framework and Doctrine use
     * 
     * @return Dweet we return $this so that we may achieve the methods chain effect above for readability
     */
    protected function initDB()
    {
        try {
            $this->db = new PDO("mysql:host={$this->config['db_host']};dbname={$this->config['db_name']}", $this->config['db_username'], $this->config['db_password']);  

            $this->db->query('SET NAMES UTF-8'); //we make sure that the MySQL will handle properly the non ASCII utf-8 characters
        } catch (Exception $e) {
            Dweet_Logger::log('error', $e->getMessage() . ' ' . $e->getTraceAsString());
        }
    
        return $this;
    }

}
