<?php

namespace lib\classes;

class LoggerClass{
    
    private $PATH;

    function __construct($fileFolder){
        $this->$PATH = $fileFolder;
        $this->init();
    }
    
    private function init(){
        d($this->$PATH."log.txt");
        $file = fopen($this->$PATH."log.txt", "w+");
        fwrite($file, "------ MidoriFramework log file ------");
        fclose($file);
    }


}

?>