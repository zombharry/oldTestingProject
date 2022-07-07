<?php

session_start();
require '..\kapcsolodas.php';

$targy=$conn->real_escape_string($_POST['tantargy']);
$sql="INSERT INTO tantargyak (megnevezes) values('$targy')";
$conn->query($sql);
header("location:tantargyak.php");
?>