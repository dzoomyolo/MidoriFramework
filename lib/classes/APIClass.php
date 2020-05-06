<?php

namespace lib\classes;

class APIClass{
    protected $answer;
    protected $methods = array();
    protected $api_path;
    protected $worked_method;
    function __construct($p){
        $this->api_path = $p;
        $this->fetchMetods();
    }
    private function fetchMetods(){
        $url = parse_url($_SERVER['REQUEST_URI']);
        $server_path = $url['path'];
        $url_arr = explode("/",$url['path']);
        $methods = scandir("./methods/");
        foreach($methods as $method){
            $methodName = explode(".",$method);
            $server_path = "./methods/".$method;
            if(is_file($server_path)&&file_exists($server_path)){
                array_push($this->methods,array("method"=>$methodName[0],"methodFile"=>$method));
            }
        }
        $this->params = $url_arr;
        $this->method = array("name"=>$url_arr[2],"success"=>0);
        $this->routeMethods();
    }
    private function routeMethods(){
        foreach($this->methods as $method){
            if($this->method["name"] == $method['method']){
                require_once("./methods/".$method['methodFile']);
                $this->method["success"] = 1;
                $this->Answer();
            }
        } 
        if($this->method["success"] != 1){
            $this->Error(404);
        }
    }
    public function Answer(){
        $a = $this->createJson($this->answer);
        $a = json_encode($a,JSON_UNESCAPED_UNICODE);
        die($a);
    }
    private function createJson($r){
        $json = new \stdClass;
        $json->result = $r;
        $json->timestamp=time();
        $json->url=$_SERVER['REQUEST_URI'];
        return $json;
    }
    public function Error($num){
        require './lib/declarations/APIErrors.php';
        $err = new \stdClass;
        $err->error=$num;
        $err->message=$errorsArray[$num];
        $e = $this->createJson($err);
        $e = json_encode($e,JSON_UNESCAPED_UNICODE);
        die($e);
    }
    public function declareMethod($methodname,$methodtype,$methodfunction){
        $url = parse_url($_SERVER['REQUEST_URI']);
        $server_path = $url['path'];
        $string = str_replace(' ', ':', $this->api_path); 
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
        $p_uri = "/".$string."/".$this->method["name"]."/".$methodname;
        if($server_path == $p_uri){
            if(strtoupper($_SERVER['REQUEST_METHOD']) === $methodtype){
                $methodfunction();
            }else{
                $this->Error(405);
            }
        }
    }
}