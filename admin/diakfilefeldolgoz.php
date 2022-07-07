<?php
require '..\kapcsolodas.php';

$fnev=$_FILES['diakokfile']['name'];
$kiterjesztes=explode(".",$fnev);
if(strtolower(end($kiterjesztes))=="csv"){
	$filenev=$_FILES['diakokfile']['tmp_name'];
	$kezelo=fopen($filenev,"r");
	while(($adat=fgetcsv($kezelo,1000,";"))!==false){
		$jelszo=password_hash($adat[2],PASSWORD_DEFAULT);
$sql="insert into diakok (osztalyid,vezeteknev,keresztnev,oktatasi_azon,jelszo) values('$adat[0]','$adat[1]','$adat[2]','$adat[3]','$jelszo');";
$conn->query($sql)or die();

		
	}
	fclose($kezelo);
	header("location:adminfooldal.php ");
}



?>