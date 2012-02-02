<?php

/**
 * the class that all the models extend
 */
abstract class BaseModel
{

    protected $db;
    public $id;

    /**
     * the construct method. We keep the db connection in a variable for easy access
     * 
     * @param type $id 
     */
    public function __construct($id = null)
    {
        $this->db = Dweet::getInstance()->db;
        
        if ($id) {
            $this->id = $id;
        }
    }

    /**
     * this method must be implemented in all the classes that extend this one
     */
    protected function create()
    {
    
    }

    /**
     * this method must be implemented in all the classes that extend this one
     */
    protected function update()
    {
    
    }

    /**
     * this method must be implemented in all the classes that extend this one
     */
    public function delete()
    {
    
    }

}
