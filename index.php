<?php

require './lib/declarations/main.php';

use lib\classes\DatabaseClass;

use lib\classes\URLClass;

use lib\classes\RouterClass;

use lib\classes\LoggerClass;

$db = new DatabaseClass(array("dsn"=>"mysql:host=localhost;dbname=anim","user"=>"root","pass"=>""));

$url = new URLClass();

$router = new RouterClass();

$logger = new LoggerClass("./Logger/");

?>
