<?php
require '..\kapcsolodas.php';

$keve=$conn->real_escape_string($_POST['kezdeseve']);
$vegzeseve=$conn->real_escape_string($_POST['vegzeseve']);
$megn=$conn->real_escape_string($_POST['megnevezes']);
$ev1=20 .$keve;
$ev2=20 .$vegzeseve;

$sql="INSERT INTO `osztalyok` ( `kezdeseve`, `vegzeseve`, `megnevezes`) VALUES ('$ev1','$ev2','$megn')";
$parancs=$conn->query($sql) or die($conn->error);
header("location:adminfooldal.php ");
?>