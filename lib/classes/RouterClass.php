<?php

namespace lib\classes;

/**
 * Route processing and routing
 * 
 * @property array $paths Found routes
 * @property array $actions The paths that the user has navigated to be routed
 */

class RouterClass{
    protected $paths = array();
    protected $actions = array();
    function __construct(){
        $this->getRoutes();
    }
    /**
     * Scanning a folder with routes, writing to a variable with a path and file
     */
    private function getRoutes(){
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
    /**
     * Checking for the existence of routes that the user came along
     */
    private function route(){
        global $url;
        $uri = $url->getUrl();
        $this->server_url_arr = $uri['path_arr'];
        foreach($this->paths as $p){
            if($p['path'] == $uri['path'] || $p['path'] == "/".$uri['path_arr'][1]."/:"){
                array_push($this->actions,$p['file']);
            }
        }
        $this->getContent();
    }
    /**
     * Start the route and create a session if it is not api (it makes no sense there)
     */
    private function getContent(){
        foreach($this->actions as $action){
            if($action != "API.php") session_start();
            require "./routes/".$action;
        }
    }

}