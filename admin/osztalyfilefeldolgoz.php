<?php
require '..\kapcsolodas.php';

$fnev=$_FILES['osztalyokfile']['name'];
$kiterjesztes=explode(".",$fnev);
if(strtolower(end($kiterjesztes))=="csv"){
	$filenev=$_FILES['osztalyokfile']['tmp_name'];
	$kezelo=fopen($filenev,"r");
	while(($adat=fgetcsv($kezelo,1000,";"))!==false){
		
$sql="insert into osztalyok (kezdeseve,vegzeseve,megnevezes) values('$adat[0]','$adat[1]','$adat[2]');";
$conn->query($sql)or die();

		
	}
	fclose($kezelo);
	header("location:adminfooldal.php ");
}



?>