<?php
session_start();
require '..\kapcsolodas.php';
$tesztid=$_POST['kerdesid'];
$_SESSION['tesztid']=$tesztid;
?>
<!DOCTYPE html>
<html>

<head>
<script src="../jquery-3.3.1.js"></script>
     <link rel="stylesheet" type="text/css" href="../css/style.css">
	 <meta charset="UTF-8">
	 <script>
	 $(document).ready(function () {
                $('form').not('#egyvtobb').hide();
            });
			
			


$(document).ready(function () {
$("#masfel").click(function () {
var rmod = $("select[name='rmod']").val();
if (rmod=="manualis"){
$('#egyvtobb').hide(1000, function () {
$('#kategoria').show(1000);
});
}
else  {
$('#egyvtobb').hide(1000, function () {
$('#filefeltoltes').show(1000);
});
}
});
});
	 
	 $(document).ready(function () {
	 
 $("#masodik").click(function () {
var kerdkat = $("select[name='kerdkat']").val();
if (kerdkat=="1"){$('#kategoria').hide(1000, function () {
$('#szbeiros').show(1000);
});
}
else if (kerdkat=='2') {$('#kategoria').hide(1000, function () {
$('#radiogombos').show(1000);
});
}
else if (kerdkat=='3') {$('#kategoria').hide(1000, function () {
$('#checkboxos').show(1000);
});
}
else if (kerdkat=='4') {                                    
{
$('#kategoria').hide(1000, function () {
$('#legordulos').show(1000);
});
}}
});
});

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

</head>

<body>
    <div class="grid-kontener">
        <div id="oldalmenu" class="oldalmenuosztaly">
            <a href="javascript:void(0)" class="bezaroGomb" onclick="menuBezar()">&times;</a>
            <ul>
                <li><a class="active" href="tanarfooldal.php">Főoldal</a></li>
				
                <li><a href="diakok.php">Diákok</a></li>
                <li><a href="osztalyok.php">Osztályok</a></li>
                <li><a href="tanarok.php">Tanárok</a></li>
                <li><a href="tantargyak.php">Tantárgyak</a></li>
                <li><a href="tesztek.php">Tesztek</a></li>
                <li><a href="ujteszt.php">Új teszt</a></li>
                <li><a href="eredmenyek.php">Eredmények</a></li>
				<li><a href="ujkep.php">Eredmények</a></li>
				
            </ul>

        </div>
        <div id="main">
            <span id="kurzor" onclick="menuMegnyit()">&#9776; Menü</span>




        </div>
        <div class="kozpont">
            <div class="urlapkinezet">
                
				
				
				<form name="egyvtobb" id="egyvtobb">
				<label for="rmod">Manuális rögzítés vagy file feltöltés</label>
				<select name="rmod" id="rmod">
				<option value="manualis">Manuális</option>
				<option value="filefeltoltes">File feltöltés</option>
				</select>
				<input type="button" value="Tovább" name="masfel" id="masfel">
				</form>
				
				<form name="filefeltoltes" id="filefeltoltes" action="tesztfeldolgozletrehoz.php">
				<label for="tesztfile">CSV file feltöltése</label>
				<input type="file" name="tesztfile" id="tesztfile">
				<input type="submit">
				
				</form>
				
				<form method="POST" action="kerdesfeldolgoz.php" id="kategoria">
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
				

                <div>
                    <a href="kijelentkezes.php"><button class="btn btn-danger gomb" name="logout" />Kijelentkezés</button></a>
                </div>
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
