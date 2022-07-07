<?php
session_start();
require '..\kapcsolodas.php';

$tesztid=$_SESSION['tesztid'];
$tipus=$_POST['tipus'];

$hszoveg=$conn->real_escape_string($_POST['hosszuszoveg']);
if (isset($_POST['szovegkep']))
{
$szkep=$_POST['szovegkep'];
}
else
{
	$szkep="";
}

$kerdes=$conn->real_escape_string($_POST['kerdes']);
if (isset($_POST['kerdeskep']))
{
$kerdeskep=$_POST['kerdeskep'];
}
else{
	$kerdeskep="";
}

$x=$_POST['mennyiseg'];
$sql="insert into kerdesek (tesztid,tipus,szoveg,szovegkep,kerdes,kerdeskep) values ('$tesztid','$tipus','$hszoveg','$szkep','$kerdes','$kerdeskep')";
$conn->query($sql);
$kerdesid=$conn->insert_id;
$jo=0;
$szamlalo=0;
while($x>$szamlalo){
	$op="opcio".$szamlalo;
	$valasz=$conn->real_escape_string($_POST["$op"]);
	if (isset($_POST['he'])){
		$jo=1;
	}
	else{
		$jo=0;
	}
	echo $jo;
	$sql2="insert into valaszlehetosegek (kerdesid,valasz,helyes_e) values('$kerdesid','$valasz',$jo)";
	$conn->query($sql2)or die();
	$jo=0;
	
	$szamlalo++;
	
}
header("location:tesztszerkeszt.php");


?>