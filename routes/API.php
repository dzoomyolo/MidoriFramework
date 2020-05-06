<?php
header("Content-Type: application/json");
use lib\classes\APIClass;
$path ="/api/:";
$api = new APIClass($path);
?>