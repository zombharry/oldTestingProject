<?php
session_start();
require 'kapcsolodas.php';


$felhasznalo=$conn->real_escape_string($_POST['tfelhasznalo']);
$jelszo=$conn->real_escape_string($_POST['tjelszo']);
$lekerdezes="select * from tanar where felhasznalonev='$felhasznalo'";
$eredmeny=$conn->query($lekerdezes);

	if($eredmeny->num_rows==0)
	{
		//nincs ilyen tanár
		
		$_SESSION['hibauzenet']="Hibás felhasználónév";
		header("location: hiba.php");
	}

	else
	{
		$belepo=$eredmeny->fetch_assoc();
			if(password_verify($jelszo,$belepo['jelszo'])){
				$_SESSION['tanarbejelentkezett'] = true;
				$_SESSION["tanar"]=$belepo["felhasznalonev"];
		    	header("location: tanar/tanarfooldal.php");
				}
			else
            {
				//hibás jelszó
				$_SESSION['hibauzenet']="Hibás jelszó";
				header("location: hiba.php");
            }
	
}

?>
