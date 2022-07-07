<?php
session_start();
require '..\kapcsolodas.php';

if ($_SESSION['adminbejelentkezett'] != 1) {
    $_SESSION['message'] = "Ahhoz hogy megtekintsd ezt az oldalt, előbb be kell jelentkezned!!";
    header("location: ..\error.php");
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$kepek=array();
$sql0="select kepnev from kepek;";
$p=$conn->query($sql0);
while($kep=$p->fetch_assoc()){
	$kepek[]=$kep['kepnev'];
}


$kerdesid=$_POST['kerdesid'];

$sql1="select * from kerdesek where kerdesid=".$kerdesid;
$parancs1=$conn->query($sql1) or die();
while($kerdes=$parancs1->fetch_array()){
	$kerdesadatok[$kerdes['kerdesid']]=$kerdes;
	
}
$sql2="select * from valaszlehetosegek where kerdesid=$kerdesid";
					$parancs2=$conn->query($sql2)or die();
					while($valaszok=$parancs2->fetch_array()){
						$kerdesadatok[$valaszok['kerdesid']]['valasz'][]=$valaszok;
						
					}

?>
<!DOCTYPE html>
<html>

<head>
     <link rel="stylesheet" type="text/css" href="../css/style.css">
	 <script src="../jquery-3.3.1.js"></script>
	 <script>
		function elemez(){
			var tipus=document.getElementById('tipus').value;
			var mennyiseg=document.getElementById('mennyiseg').value;
			
			$.ajax({
				type:"get",
				url: "ajaxmiatt.php",
				data:{btipus: tipus, mennyiseg: mennyiseg},
				cache:false,
				success: function(html){
					$('#kerdesfelvitel').html(html);
					
				}
			});
			return false;
		}
	 function kepmutat1(){
			var szovegkep=document.getElementById('szovegkep').value;
			
			
			$.ajax({
				type:"get",
				url: "ajax2.php",
				data:{szkep: szovegkep},
				cache:false,
				success: function(html){
					$('#kepmutato1').html(html);
					
				}
			});
			return false;
		}
		 function kepmutat2(){
			var kerdeskep=document.getElementById('kerdeskep').value;
			
			
			$.ajax({
				type:"get",
				url: "ajax3.php",
				data:{kkep: kerdeskep},
				cache:false,
				success: function(html){
					$('#kepmutato2').html(html);
					
				}
			});
			return false;
		}
	 
	 </script>
	<meta charset="UTF-8">
</head>

<body>
    <div class="grid-kontener">
        <div id="oldalmenu" class="oldalmenuosztaly">
            <a href="javascript:void(0)" class="bezaroGomb" onclick="menuBezar()">&times;</a>
            <ul>
                <li><a class="active" href="adminfooldal.php">Főoldal</a></li>
				<li><a href="#">Új szak</a></li>
                <li><a href="diakok.php">Diákok</a></li>
                <li><a href="ujdiak.php">Új diák</a></li>
                <li><a href="osztalyok.php">Osztályok</a></li>
                <li><a href="ujosztaly.php">Új osztály</a></li>
                <li><a href="tanarok.php">Tanárok</a></li>
                <li><a href="ujtanar.php">Új tanár</a></li>
				<li><a href="adminok.php">Adminok</a></li>
				<li><a href="regisztracio.php">Új admin</a></li>
                <li><a href="tantargyak.php">Tantárgyak</a></li>
                <li><a href="ujtantargy.php">Új tantárgy</a></li>
                <li><a href="tesztek.php">Tesztek</a></li>
                <li><a href="ujteszt.php">Új teszt</a></li>
                <li><a href="eredmenyek.php">Eredmények</a></li>
				<li><a href="ujkep.php">Kép feltöltés</a></li>
            </ul>

        </div>
        <div id="main">
            <span id="kurzor" onclick="menuMegnyit()">&#9776; Menü</span>




        </div>
        <div class="kozpont">
            <div class="urlapkinezet">
                <h1>Kérdés módosítása</h1>
				<fieldset>
				<legend></legend>
				<form action="modositas.php" method="POST">
				<?php
				foreach ($kerdesadatok as $kerdes){
					echo "Típus: ";
					if($kerdes['tipus']==1){
						echo 'Rádió gombos <br>';
						echo "Hosszú szöveg ".$kerdes['szoveg']."<br>";
				if(!empty($kerdes['szovegkep'])){
				echo  "<img src='../kepek/".$kerdes['szovegkep']."' alt='kep'/>"."<br>";}
				echo "Kérdés: ".$kerdes['kerdes']."<br>";
				
				if(!empty($kerdes['kerdeskep'])){
				echo  "<img src='../kepek/".$kerdes['kerdeskep']."' alt='kep'/>"."<br>";}
				echo "Válaszok: ";
				foreach($kerdes['valasz'] as $v){
					echo $v['valasz']."<br>";
					if( $v['helyes_e']==1){
						echo"✔ <br>";
					}else{ echo "<br>";}
				echo "<br>";}
						
					}
					
					elseif($kerdes['tipus']==2){
						echo 'Szövegbeírós <br>';
						echo "Hosszú szöveg: ".$kerdes['szoveg']."<br>";
				if(!empty($kerdes['szovegkep'])){
				echo  "<img src='../kepek/".$kerdes['szovegkep']."' alt='kep'/>"."<br>";}
				echo "Kérdés: ".$kerdes['kerdes']."<br>";
				
				if(!empty($kerdes['kerdeskep'])){
				echo  "<img src='../kepek/".$kerdes['kerdeskep']."' alt='kep'/>"."<br>";}
				echo "Kulcsszavak: ";
				foreach($kerdes['valasz'] as $v){
					
					if( $v['helyes_e']==1){
						echo $v['valasz']."<br>";
					};
				echo "<br>";}
					
						
					}
					elseif($kerdes['tipus']==3){
						echo 'Checkbox ';
						echo "Hosszú szöveg ".$kerdes['szoveg']."<br>";
				if(!empty($kerdes['szovegkep'])){
				echo  "<img src='../kepek/".$kerdes['szovegkep']."' alt='kep'/>"."<br>";}
				echo "Kérdés: ".$kerdes['kerdes']."<br>";
				
				if(!empty($kerdes['kerdeskep'])){
				echo  "<img src='../kepek/".$kerdes['kerdeskep']."' alt='kep'/>"."<br>";}
				echo "Válaszok: ";
				foreach($kerdes['valasz'] as $v){
					echo $v['valasz']."<br>";
					if( $v['helyes_e']==1){
						echo"✔ <br>";
					}else{ echo "<br>";}
				echo "<br>";}
						
					}
					elseif($kerdes['tipus']==4){
						echo 'Legördülő menü<br>';
						echo "Hosszú szöveg: ".$kerdes['szoveg']."<br>";
				if(!empty($kerdes['szovegkep'])){
				echo  "<img src='../kepek/".$kerdes['szovegkep']."' alt='kep'/>"."<br>";}
				echo "Kérdés: ".$kerdes['kerdes']."<br>";
				
				if(!empty($kerdes['kerdeskep'])){
				echo  "<img src='../kepek/".$kerdes['kerdeskep']."' alt='kep'/>"."<br>";}
				echo "Válaszok: ";
				foreach($kerdes['valasz'] as $v){
					echo $v['valasz'];
					if( $v['helyes_e']==1){
						echo"✔ <br>";
					}else{ echo "<br>";}
				echo "<br>";}
						
					}
				
				}
				
				?>
				</fieldset>
				<fieldset>
				<legend>Kérdés beállítások</legend>
				<select id="tipus" name="tipus" onChange="return elemez()">
				
				<option value="0">Beviteli mező választása</option>
				<option value="1">Rádió(1 megoldás)</option>
				<option value="2">Szövegbeírós(kulcs szavak)</option>
				<option value="3">Checkbox(több megoldás)</option>
				<option value="4">Legördülő(1 megoldás)</option>
				</select>
				<label for="hosszuszoveg">Hosszú szöveg (Szöveges feladatokhoz) </label>
				<textarea rows="4" cols="50" name="hosszuszoveg" id="hosszuszoveg"></textarea>
				
				<label for="szovegkep">Szöveghez tartozó kép</label>
				<select name="szovegkep" id="szovegkep" onClick="return kepmutat1()">
				<option>Szöveg kép kiválasztása</option>
				<?php 
				for($k=0;$k<sizeof($kepek);$k++){
					echo "<option value='".$kepek[$k]."'>".$kepek[$k]."</option>";
					
				}
				?>
				</select>
				<fieldset id="kepmutato1" name="kepmutato1"></fieldset>
				<label for="kerdes">Kérdés</label>
				<input type="text" name="kerdes" id="kerdes">
				
				<label for="kerdeskep">Kérdéshez tartozó kép</label>
				<select name="kerdeskep" id="kerdeskep" onClick="return kepmutat2()">
				<option>Kérdés kép kiválasztása</option>
				<?php 
				for($k=0;$k<sizeof($kepek);$k++){
					echo "<option value='".$kepek[$k]."'>".$kepek[$k]."</option>";
					
				}
				?>
				</select>
				<fieldset id="kepmutato2" name="kepmutato2"></fieldset>
				
				<label for="mennyiseg">Válaszok mennyisége</label>
				<input type="number" name="mennyiseg" id="mennyiseg" min='1' value="1" onChange="return elemez()">
				</fieldset>
				
				<fieldset id="kerdesfelvitel" name="kerdesfelvitel">
				<legend>Válasz lehetőségek</legend>
				</fieldset>
				
				
				<input  type="submit" value="Rögzítés">
				</form>
                
            </div>
        </div>

</body>
<script>
    function menuMegnyit() {
        document.getElementById("oldalmenu").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    function menuBezar() {
        document.getElementById("oldalmenu").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }

</script>

</html>
