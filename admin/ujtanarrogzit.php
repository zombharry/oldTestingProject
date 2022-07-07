<?php

session_start();
require '..\kapcsolodas.php';

$felhasznalo=$conn->real_escape_string($_POST['tfnev']);
$knev=$conn->real_escape_string($_POST['tknev']);
$vnev=$conn->real_escape_string($_POST['tvnev']);
$jelszo=$conn->real_escape_string(password_hash($_POST['jelszo'],PASSWORD_DEFAULT));


$parancs="INSERT INTO tanar( felhasznalonev, jelszo, vezeteknev,keresztnev) VALUES ('$felhasznalo','$jelszo','$vnev','$knev')";
$felvitel=$conn->query($parancs);


header('location:adminfooldal.php');