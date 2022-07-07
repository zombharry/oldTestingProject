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
$sql="SELECT ta.megnevezes as tantargy,te.tema,te.megnevezes,d.vezeteknev,d.keresztnev,k.szoveg,k.szovegkep,k.kerdes,k.kerdeskep,dv.diakvalasza,dv.helyes FROM diakokvalaszai dv,tantargyak ta,tesztek te, diakok d, kerdesek k where dv.diakid=d.diakid and ta.tantargyid=te.tantargyid and k.kerdesid=dv.kerdesid";

?>
<!DOCTYPE html>
<html>

<head>
    <script src="../jquery-3.3.1.js"></script>
<script src="../jquery_redirect.js"></script>
<!-- https://github.com/mgalante/jquery.redirect/blob/master/jquery.redirect.js    --> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/style.css">

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
                <li><a href="ujosztaly.php">Új osztály</a></li>
                <li><a href="tanarok.php">Tanárok</a></li>
                <li><a href="ujtanar.php">Új tanár</a></li>
				
				<li><a href="regisztracio.php">Új admin</a></li>
                <li><a href="tantargyak.php">Tantárgyak</a></li>
                <li><a href="ujtantargy.php">Új tantárgy</a></li>
                <li><a href="tesztek.php">Tesztek</a></li>
                <li><a href="ujteszt.php">Új teszt</a></li>
                <li><a href="#">Eredmények</a></li>
				<li><a href="ujkep.php">Kép feltöltés</a></li>
            </ul>

        </div>
        <div id="main">
            <span id="kurzor" onclick="menuMegnyit()">&#9776; Menü</span>




        </div>
        <div class="kozpont">
            <div class="urlapkinezet">
                <h1>Eredmények</h1>
				<?php 
				$lek=$conn->query($sql);
				if(mysqli_num_rows($lek)==0){echo "Jelenleg nincsenek megjelenítendő eredmények!" ;}
				else{
					echo "<table>";
					echo "<tr>";
					echo "<th> Teszt </th>";
					echo "<th> Diák </th>";
					echo "<th> Kérdés </th>";
					echo "<th> Válasz </th>";
					echo "<th> Helyes </th>";
					echo "</tr>";
					while($sor=$lek->fetch_array()){
						echo "<tr>";
						echo "<td>".$sor['tantargy']." ".$sor['tema']." ".$sor['megnevezes']."</td>";
						echo "<td>".$sor['vezeteknev']." ".$sor['keresztnev']."</td>";
						echo "<td>".$sor['szoveg']." ".$sor['kerdes']."</td>";
						echo "<td>".$sor['diakvalasza']."</td>";
						echo "<td>".$sor['helyes']."</td>";
						echo "</tr>";
					}
					
				}
				?>
				

					
					
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
