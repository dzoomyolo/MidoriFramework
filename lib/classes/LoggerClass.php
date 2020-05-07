<?php

namespace lib\classes;

/**
 * Logging actions to a file
 * 
 * @property string $PATH_FOLDER Folder for logs
 * @property string $PATH Full path to file
 * @property string $FILE Opened file
 */

class LoggerClass{
    
    private $PATH_FOLDER;
    private $PATH;
    private $FILE;

    function __construct($fileFolder){
        $this->PATH_FOLDER = $fileFolder;
        $this->PATH = $this->PATH_FOLDER.date("Y-m-d")."-log.txt"; 
        $this->init();
    }
    /**
     * Create or open log file
     */
    private function init(){
        if(!file_exists($this->PATH)){
            $this->FILE = fopen($this->PATH, 'a');
            fwrite($this->FILE, "------ MidoriFramework log file ------\n");
        }else{
            $this->FILE = fopen($this->PATH, 'a');
        }
    }
    /**
     * Append text to this file
     */
    private function __write($s){
        file_put_contents($this->PATH, $s, FILE_APPEND | LOCK_EX);
    }

    public function log($string){
        $s = '['.date('D M d H:i:s Y',time()).'] '.$string."\n";
        $this->__write($s);
    }
    /**
     * Close file $FILE
     */
    function __destruct(){
        fclose($this->FILE);
    }
}

?>