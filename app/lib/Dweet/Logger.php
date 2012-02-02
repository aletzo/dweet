<?php

class Dweet_Logger
{

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
