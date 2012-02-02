<?php

abstract class BaseModel
{

    protected $db;
    public $id;

    public function __construct($id = null)
    {
        $this->db = Dweet::getInstance()->db;
        
        if ($id) {
            $this->id = $id;
        }
    }

    protected function create()
    {
    
    }

    protected function update()
    {
    
    }

    public function delete()
    {
    
    }

}
