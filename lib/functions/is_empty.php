<?php
function is_empty(&$var)
{
    return !($var || (is_scalar($var) && strlen($var)));
}
?>