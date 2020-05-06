<?php

require './lib/declarations/main.php';

use lib\classes\DatabaseClass;

use lib\classes\RouterClass;

$db = new DatabaseClass(array("dsn"=>"mysql:host=localhost;dbname=anim","user"=>"root","pass"=>""));

$router = new RouterClass();

?>
