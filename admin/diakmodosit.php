<?php
session_start();
require '..\kapcsolodas.php';
$diakid=$_POST['diakid'];
$vnev=$_POST['vnev'];
$knev=$_POST['knev'];
$osztaly=$_POST['osztaly'];
$okazon=$_POST['okazon'];
$sql="update diakok set vezeteknev='".$vnev."', keresztnev='".$knev."', oktatasi_azon='".$okazon."',osztalyid='".$osztaly."' where diakid=".$diakid;
 $conn->query($sql) or die();
header("location:diakok.php");
?>