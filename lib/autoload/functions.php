<?php
$functions = scandir("./lib/functions/");
foreach($functions as $function){
    $function_path = "./lib/functions/".$function;
    if(is_file($function_path)&&file_exists($function_path)){
        require $function_path;
    }
}
?>