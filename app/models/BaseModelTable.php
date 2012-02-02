<?php

/**
 * this class must extend all the classes that perform "mysql select" on the models
 */
abstract class BaseModelTable
{
    
    /**
     * this method must be implemented in all the classes that extend this one
     */
    static public function load()
    {
    
    }
    
    /**
     * this method must be implemented in all the classes that extend this one
     */
    static public function listall()
    {
        
    }

}
