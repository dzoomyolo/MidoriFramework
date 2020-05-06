<?php

namespace lib\classes;

class RouterClass{
    protected $paths = array();
    protected $actions = array();
    function __construct(){
        $this->getRoutes();
    }
    function getRoutes(){
        $fileClasses = scandir("./routes");
        foreach($fileClasses as $class){
            $path = "./routes/".$class;
            if(is_file($path)&&file_exists($path)){
                $file_content = file($path);
                foreach($file_content as $element){
                    if(!is_empty(strpos($element,'$path'))){
                        $var = stristr($element, '"');
                        $var = substr($var,1);
                        $lenght = stripos($var,'"');
                        $var = substr($var,0,$lenght);
                        array_push($this->paths,array("path"=>$var,"file"=>$class));
                    }
                }
                
            }
        }
        $this->route();
    }
    function route(){
        $url = parse_url($_SERVER['REQUEST_URI']);
        $path = $url['path'];
        $path_array = explode("/",$url['path']);
        $this->server_url_arr = $path_array;
        foreach($this->paths as $p){
            if($p['path'] == $path || $p['path'] == "/".$path_array[1]."/:"){
                array_push($this->actions,$p['file']);
            }
        }
        $this->getContent();
    }
    function getContent(){
        // if(empty($this->actions)){
        //     echo '<meta http-equiv="refresh" content="0;url=/404" />';
        // }
        foreach($this->actions as $action){
            if($action != "API.php") session_start();
            require "./routes/".$action;
        }
    }

}