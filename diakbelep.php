<?php
session_start();
require 'kapcsolodas.php';

$felhasznalo=$conn->real_escape_string($_POST['oktazon']);
$jelszo=$conn->real_escape_string($_POST['djelszo']);

$lekerdezes="select * from diakok where oktatasi_azon='$felhasznalo'";
$eredmeny=$conn->query($lekerdezes);

	if($eredmeny->num_rows==0)
	{
		//nincs ilyen diák
		
		$_SESSION['hibauzenet']="Hibás felhasználónév";
		header("location: hiba.php");
	}

	else
	{
		$belepo=$eredmeny->fetch_assoc();
			if(password_verify($jelszo,$belepo['jelszo'])){
				$_SESSION['diakbejelentkezett'] = true;
				$_SESSION['diak']=$belepo['oktatasi_azon'];
		    	header("location: diak/tanulofooldal.php");
				}
			else{
				//hibás jelszó
				$_SESSION['hibauzenet']="Hibás jelszó";
				header("location: hiba.php");
		
	}
	
}

?>

