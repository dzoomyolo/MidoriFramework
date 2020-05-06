<?php
spl_autoload_register(function($class){
    $path = $_SERVER['CONTEXT_DOCUMENT_ROOT'].'/'.str_replace("\\","/",$class).".php";
    require $path;
});
?>