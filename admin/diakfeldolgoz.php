<?php
require '..\kapcsolodas.php';

$okazon=$conn->real_escape_string($_POST['okazon']);
$osztaly=$conn->real_escape_string($_POST['osztaly']);
$knev=$conn->real_escape_string($_POST['knev']);
$vnev=$conn->real_escape_string($_POST['vnev']);
$jelszo=$conn->real_escape_string(password_hash($knev,PASSWORD_DEFAULT));

$sql="INSERT INTO `diakok` ( `osztalyid`, `vezeteknev`, `keresztnev`, `oktatasi_azon`, `jelszo`) VALUES ('$osztaly','$vnev','$knev','$okazon','$jelszo')";
$parancs=$conn->query($sql) or die($conn->error);
header("location:adminfooldal.php ");
?>