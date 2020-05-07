<?php

namespace lib\classes;

class LoggerClass{
    
    private $PATH_FOLDER;
    private $PATH;
    private $FILE;

    function __construct($fileFolder){
        $this->PATH_FOLDER = $fileFolder;
        $this->PATH = $this->PATH_FOLDER.date("Y-m-d")."-log.txt"; 
        $this->init();
    }
    private function init(){
        if(!file_exists($this->PATH)){
            $this->FILE = fopen($this->PATH, 'a');
            fwrite($this->FILE, "------ MidoriFramework log file ------\n");
        }else{
            $this->FILE = fopen($this->PATH, 'a');
        }
    }
    private function __write($s){
        file_put_contents($this->PATH, $s, FILE_APPEND | LOCK_EX);
    }
    public function log($string){
        $s = '['.date('D M d H:i:s Y',time()).'] '.$string."\n";
        $this->__write($s);
    }
    function __destruct(){
        fclose($this->FILE);
    }
}

?>