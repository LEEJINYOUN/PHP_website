<?php
header('Content-Type: text/html; charset=utf-8');
$connnect = mysqli_connect('localhost','root', '!!@@eorhr1202');
mysqli_select_db($connnect, 'php_website');
$connnect->set_charset('utf8');
?>