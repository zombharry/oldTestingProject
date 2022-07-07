<?php
session_start();
require 'kapcsolodas.php';

$felhasznalo=$conn->real_escape_string($_POST['afelhasznalo']);
$jelszo=$conn->real_escape_string($_POST['ajelszo']);
$elozetesvizsgalat="select * from adminok";
$teszteles=$conn->query($elozetesvizsgalat) or die("elso lekerdezesnél a hiba");
$lekerdezes="select * from adminok where felhasznalonev='$felhasznalo'";
$eredmeny=$conn->query($lekerdezes);
if($teszteles->num_rows==0){
	
	//Ha a tábla üres lenne egy véletlen törlés miatt, akkor így lehet belépni.
	
	 if($felhasznalo=="tartalekadmin" and $jelszo=="tartalek"){
		$_SESSION['adminbejelentkezett'] = true;
		$_SESSION["admin"]="tartalek";
		    	 header("location: admin/adminfooldal.php");
	}
	else{
		$_SESSION['hibauzenet']="Hibás felhasználónév";
		header("location: hiba.php");
	}
	
}
else{
	if($eredmeny->num_rows==0)
	{
		//nincs ilyen admin
		
		$_SESSION['hibauzenet']="Hibás felhasználónév";
		header("location: hiba.php");
	}

	else
	{
		$belepo=$eredmeny->fetch_assoc();
			if(password_verify($jelszo,$belepo['jelszo'])){
				$_SESSION['adminbejelentkezett'] = true;
				$_SESSION["admin"]=$belepo["felhasznalonev"];
		    	header("location: admin/adminfooldal.php");
				}
			else{
				//hibás jelszó
				$_SESSION['hibauzenet']="Hibás jelszó";
				header("location: hiba.php");
		
	}
	
}
}
?>
