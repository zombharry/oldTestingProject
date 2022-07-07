<?php
session_start();
require '..\kapcsolodas.php';
if ( $_SESSION['tanarbejelentkezett'] != 1 ) {
  $_SESSION['hibauzenet'] = "Ahhoz hogy megtekintsd ezt az oldalt, előbb be kell jelentkezned!!";
  header("location: ../hiba.php");    
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta charset="UTF-8">

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
                <h1>Üdvözöllek</h1>

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
