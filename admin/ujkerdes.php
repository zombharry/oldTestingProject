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
                <li><a class="active" href="adminfooldal.php">F??oldal</a></li>
				
                <li><a href="diakok.php">Di??kok</a></li>
                <li><a href="ujdiak.php">??j di??k</a></li>
                <li><a href="osztalyok.php">Oszt??lyok</a></li>
                <li><a href="ujosztaly.php">??j oszt??ly</a></li>
                <li><a href="tanarok.php">Tan??rok</a></li>
                <li><a href="ujtanar.php">??j tan??r</a></li>
				
				<li><a href="regisztracio.php">??j admin</a></li>
                <li><a href="tantargyak.php">Tant??rgyak</a></li>
                <li><a href="ujtantargy.php">??j tant??rgy</a></li>
                <li><a href="tesztek.php">Tesztek</a></li>
                <li><a href="#">??j teszt</a></li>
                <li><a href="eredmenyek.php">Eredm??nyek</a></li>
				<li><a href="ujkep.php">K??p felt??lt??s</a></li>
            </ul>

        </div>
        <div id="main">
            <span id="kurzor" onclick="menuMegnyit()">&#9776; Men??</span>




        </div>
        <div class="kozpont">
            <div class="urlapkinezet">
                
				
				
				<form name="egyvtobb" id="egyvtobb">
				<label for="rmod">Manu??lis r??gz??t??s vagy file felt??lt??s</label>
				<select name="rmod" id="rmod">
				<option value="manualis">Manu??lis</option>
				<option value="filefeltoltes">File felt??lt??s</option>
				</select>
				<input type="button" value="Tov??bb" name="masfel" id="masfel">
				</form>
				
				<form name="filefeltoltes" id="filefeltoltes" action="tesztfeldolgozletrehoz.php">
				<label for="tesztfile">CSV file felt??lt??se</label>
				<input type="file" name="tesztfile" id="tesztfile">
				<input type="submit">
				
				</form>
				
				<form method="POST" action="kerdesfeldolgoz.php" id="kategoria" name="kategoria">
				<legend>K??rd??s be??ll??t??sok</legend>
				<select id="tipus" name="tipus" onChange="return elemez()">
				
				<option value="0">Beviteli mez?? v??laszt??sa</option>
				<option value="1">R??di??(1 megold??s)</option>
				<option value="2">Sz??vegbe??r??s(kulcs szavak)</option>
				<option value="3">Checkbox(t??bb megold??s)</option>
				<option value="4">Leg??rd??l??(1 megold??s)</option>
				</select>
				<label for="hosszuszoveg">Hossz?? sz??veg (Sz??veges feladatokhoz) </label>
				<textarea rows="4" cols="50" name="hosszuszoveg" id="hosszuszoveg"></textarea>
				
				<label for="szovegkep">Sz??veghez tartoz?? k??p</label>
				<select name="szovegkep" id="szovegkep" onClick="return kepmutat1()">
				<option>Sz??veg k??p kiv??laszt??sa</option>
				<?php 
				for($k=0;$k<sizeof($kepek);$k++){
					echo "<option value='".$kepek[$k]."'>".$kepek[$k]."</option>";
					
				}
				?>
				</select>
				<fieldset id="kepmutato1" name="kepmutato1"></fieldset>
				<label for="kerdes">K??rd??s</label>
				<input type="text" name="kerdes" id="kerdes">
				
				<label for="kerdeskep">K??rd??shez tartoz?? k??p</label>
				<select name="kerdeskep" id="kerdeskep" onClick="return kepmutat2()">
				<option>K??rd??s k??p kiv??laszt??sa</option>
				<?php 
				for($k=0;$k<sizeof($kepek);$k++){
					echo "<option value='".$kepek[$k]."'>".$kepek[$k]."</option>";
					
				}
				?>
				</select>
				<fieldset id="kepmutato2" name="kepmutato2"></fieldset>
				
				<label for="mennyiseg">V??laszok mennyis??ge</label>
				<input type="number" name="mennyiseg" id="mennyiseg" min='1' value="1" onChange="return elemez()">
				</fieldset>
				
				<fieldset id="kerdesfelvitel" name="kerdesfelvitel">
				<legend>V??lasz lehet??s??gek</legend>
				</fieldset>
				
				
				<input  type="submit" value="R??gz??t??s">
				</form>
				

                <div>
                    <a href="kijelentkezes.php"><button class="btn btn-danger gomb" name="logout" />Kijelentkez??s</button></a>
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
