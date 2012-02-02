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

class Dweet
{
    static protected $instance = null;

    public $config = null;
    public $db     = null;

    static public function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

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

    protected function configure()
    {
        try {
            $this->config = require_once PROJECT_ROOT . '/app/config/config.php';
        } catch (Exception $e) {
            Dweet_Logger::log('error', $e->getMessage() . ' ' . $e->getTraceAsString());
        }

        return $this;
    }

    protected function initDB()
    {
        try {
            $this->db = new PDO("mysql:host={$this->config['db_host']};dbname={$this->config['db_name']}", $this->config['db_username'], $this->config['db_password']);  

            $this->db->query('SET NAMES UTF-8');
        } catch (Exception $e) {
            Dweet_Logger::log('error', $e->getMessage() . ' ' . $e->getTraceAsString());
        }
    
        return $this;
    }

}
