<?php

/**
 * a class that keeps the Dweet logs
 */
class Dweet_Logger
{
    /**
     * based on the defined $type (e.g. debug, error, sql) it logs 
     * to the corresponding file the passed data. It can really
     * help during debugging
     * 
     * @param type $type the file to log to the data
     * @param type $data the data to log
     */
    public static function log($type, $data)
    {
        
        $filename = PROJECT_ROOT . "/log/{$type}.dat";

        $fp = fopen($filename, 'a');
        
        if (is_array($data)) {
            $data = 'array: ' . json_encode($data);
        }

        if (is_object($data)) {
            $data = 'object ' . serialize($data);
        }
        
        $data = date("Y M d, H:i:s")." --- " . $data;
        $data .= "\n\n=====================\n\n";

        fwrite($fp, $data);
        fclose($fp);
    }

}
