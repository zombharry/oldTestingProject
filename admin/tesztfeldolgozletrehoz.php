<?php
require '..\kapcsolodas.php';
session_start();

$tesztid=$_SESSION['tesztid'];
$fnev=$_FILES['tesztfile']['name'];
$kiterjesztes=explode(".",$fnev);
if(strtolower(end($kiterjesztes))=="csv"){
	$filenev=$_FILES['diakokfile']['tmp_name'];
	$kezelo=fopen($filenev,"r");
	$kerdese=true;
	$uresszamlalo=0;
	
	while(($adat=fgetcsv($kezelo,1000,";"))!==false){
		if($kerdese==true){
			$sql="insert into kerdesek (tesztid, tipus, szoveg,kerdes) values('$tesztid','$adat[0]','$adat[1]','$adat[2]')";
			if($conn->query($sql)==true){
				$kerdesid=$conn->inserted_id;
				$kerdese=false;
			}
			elseif(empty($adat)){
				$kerdese=true;
				$uresszamlalo++;
				if($uresszamlalo==2){
					fclose($kezelo);
	header("location:adminfooldal.php ");
				}
			}
			
		}elseif($uresszamlalo!=1){
$sql="insert into valaszlehetosegek (kerdesid,vezeteknev,keresztnev,oktatasi_azon,jelszo) values('$adat[0]','$adat[1]','$adat[2]','$adat[3]','$jelszo');";
		$conn->query($sql)or die();
		$uresszamlalo=0;}

		
	}
	fclose($kezelo);
	header("location:adminfooldal.php ");
}



?>