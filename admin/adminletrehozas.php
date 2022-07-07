<?php

session_start();
require '..\kapcsolodas.php';

$felhasznalo=$conn->real_escape_string($_POST['felhasznalonev']);
$jelszo=$conn->real_escape_string(password_hash($_POST['jelsz1'],PASSWORD_DEFAULT));

$parancs="INSERT INTO adminok( felhasznalonev, jelszo) VALUES ('$felhasznalo','$jelszo')";
$felvitel=$conn->query($parancs);

header('location:adminfooldal.php');