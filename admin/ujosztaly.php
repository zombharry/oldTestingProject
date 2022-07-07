<?php
session_start();
require '..\kapcsolodas.php'
?>
<!DOCTYPE html>
<html>

<head>
<script src="../jquery-3.3.1.js"></script>

<script> 
$(document).ready(function () {
                $('form').hide();
            });
			
$(document).ready(function () {	 
$("#tobbhoz").click(function () {
$('#egyhez,#tobbhoz ').hide(1000, function () {
$('.tobb').show(1000);
		});
	});
});			

$(document).ready(function () {	 
$(".vissza").click(function () {
$('form').hide(1000, function () {
$('#tobbhoz,#egyhez').show(1000);
		});
	});
});		
$(document).ready(function () {	 
$("#egyhez").click(function () {
$('#egyhez,#tobbhoz ').hide(1000, function () {
$('#egy').show(1000);
		});
	});
});				
</script>
     <link rel="stylesheet" type="text/css" href="../css/style.css">
	 <meta charset="UTF-8">
</head>

<body>
    <div class="grid-kontener">
        <div id="oldalmenu" class="oldalmenuosztaly">
            <a href="javascript:void(0)" class="bezaroGomb" onclick="menuBezar()">&times;</a>
            <ul>
                <li><a class="active" href="adminfooldal.php">Főoldal</a></li>
				
                <li><a href="diakok.php">Diákok</a></li>
                <li><a href="ujdiak.php">Új diák</a></li>
                <li><a href="osztalyok.php">Osztályok</a></li>
                <li><a href="#">Új osztály</a></li>
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
                <h1>Új osztály</h1>
				<button id="tobbhoz"> Több osztály felvitele filefeltöltéssel</button>
				<button id="egyhez">Egy osztály felvitele</button>
				<form action="osztalyfilefeldolgoz.php" method="post" class="tobb" enctype="multipart/form-data">
				<input type="button" class="vissza" value="&#8592; "> 
				<input type="file" name="osztalyokfile" id="osztalyokfile">
				<input type="submit">
				</form>
				<form action="osztalyfeldolgoz.php" method="post" id='egy'>
				<input type="button" class="vissza" value="&#8592; ">
				<label for="kezdeseve">Kezdés éve: </label>
				<input type="number" name="kezdeseve" id="kezdeseve" min="17" max="98" required>
				<label for="vegzeseve">Végzés éve: </label>
				<input type="number" name="vegzeseve" id="vegzeseve" min="18" max="99" required>
				<label for="megnevezes">Megnevezés: </label>
				<input type="text" name="megnevezes" id="megnevezes" required>
				<input type="submit">
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
