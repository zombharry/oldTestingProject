<?php
session_start();
require '..\kapcsolodas.php';

if ( $_SESSION['adminbejelentkezett'] != true ) {
  $_SESSION['hibauzenet'] = "Ahhoz hogy megtekintsd ezt az oldalt, előbb be kell jelentkezned!!";
  header("location: ../hiba.php");    
}
?>

<!DOCTYPE html>

<html>

<head>
    <title>bejeletkezés</title>
	<script src="../jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



</head>

<body>
<div class="grid-kontener">
        <div id="oldalmenu" class="oldalmenuosztaly">
            <a href="javascript:void(0)" class="bezaroGomb" onclick="menuBezar()">&times;</a>
            <ul>
                <li><a class="active" href="#">Főoldal</a></li>
				
                <li><a href="diakok.php">Diákok</a></li>
                <li><a href="ujdiak.php">Új diák</a></li>
                <li><a href="osztalyok.php">Osztályok</a></li>
                <li><a href="ujosztaly.php">Új osztály</a></li>
                <li><a href="tanarok.php">Tanárok</a></li>
                <li><a href="ujtanar.php">Új tanár</a></li>
				
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
		<form method="post" action="adminletrehozas.php">
			<label for="felhasznalonev">Felhasználónév</label>
			<input type="text" name="felhasznalonev" id="felhasznalonev">
			<label for="jelsz1">Jelszó</label>
			<input type="password" name="jelsz1" id="jelsz1">
			<label for="jelsz2">Jelszó megerősítése</label>
			<input type="password" name="jelsz2" id="jelsz2">
			<span id="kiiras" class="figyel rejtett">A két jelszó nem egyezik</span>
			<input type="submit" id="engedely"  value="Regisztrálás" disabled="disabled">
		</form>
    </div>
</div>

</body>
<script type="text/javascript">


$(document).ready(function(){
	$('#jelsz2').keyup(function(){
		if($(this).val()== $('#jelsz1').val() && $(this).val!="")
		{
			$('#kiiras').addClass('rejtett');
			$("#engedely").prop("disabled",false)
		}
		else
		{
			$('#kiiras').removeClass('rejtett');
			$("#engedely").prop("disabled",true)
		}
	});
});

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
