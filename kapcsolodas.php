<?php
$host='localhost';
$felh='root';
$jelsz='';
$ab='szakdolgozat_ab';
$conn=new mysqli($host,$felh,$jelsz,$ab) or die('Hiba a kapcsolódáskor');
$conn->query("SET NAMES UTF8");
$conn->query("set character set UTF8");
$conn->query("set collation_connection='utf8_hungary_ci'");

?>