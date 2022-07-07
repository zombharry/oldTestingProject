<?php


$kimenet=$_GET['btipus'];
$mennyiseg=$_GET['mennyiseg'];
echo "<legend>Válasz lehetőségek</legend>";
if($kimenet==1 || $kimenet==4){
	for($szamlalo=0;$szamlalo<$mennyiseg;$szamlalo++ ){
	
	 echo '<input type="text" name="opcio'.$szamlalo.'" id="opcioegy'.$szamlalo.'">';
	 echo '<input type="radio" name="he" id="he'.$szamlalo.'" value=1><br>';

	}
}
elseif($kimenet==2){
	echo "Kulcsszavak";
	for($szamlalo=0;$szamlalo<$mennyiseg;$szamlalo++ ){
		
	
	 echo '<input type="text" name="opcio" id="opcio">';
	 echo '<input type="checkbox" class="semmi" name=="he"  id="he'.$szamlalo.'" value=1 checked><br>';
	
	
	}
	
}
elseif($kimenet==3){
	for($szamlalo=0;$szamlalo<$mennyiseg;$szamlalo++ ){
	
	echo '<input type="text" name="opcio'.$szamlalo.'" id="opcioegy'.$szamlalo.'" form="kategoria">';
	 echo 'Helyes-e? <input type="checkbox" name="he"  id="he'.$szamlalo.'" value=1 form="kategoria"><br>';
	
	}
}
?>