<?php
session_start();
require '..\kapcsolodas.php';

$sql="select tesztek.tesztid,tesztek.tema,tesztek.megnevezes as tesztmeg,tesztek.aktiv,tantargyak.tantargyid,tantargyak.megnevezes as tanmeg,tanitasok.tanarid,osztalyok.kezdeseve,osztalyok.vegzeseve,osztalyok.megnevezes as omeg from (((tesztek inner join tantargyak on tesztek.tantargyid=tantargyak.tantargyid)inner join tanitasok on tantargyak.tantargyid=tanitasok.tantargyid)inner join osztalyok on osztalyok.osztalyid=tanitasok.osztalyid)";

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
                <li><a href="#">Tesztek</a></li>
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
                <h1>Üdvözöllek</h1>
				
				<table>
					<th>téma</th>
					<th>megnevezés</th>
					<th>tantárgy</th>
					<th>tanár</th>
					<th>osztály</th>
					<?php
					$lek1=$conn->query($sql);
					while($s=$lek1->fetch_assoc()){
						?> <tr class="kattinthato" onmousedown="$.redirect('tesztszerkeszt.php',{tesztid:<?php echo $s['tesztid']?>})"> <?php
						
						
						echo "<td>".$s['tema']." </td>";
						echo "<td>".$s['tesztmeg']."</td>";
						echo "<td>".$s['tanmeg']."</td>";
						echo "<td>".$s['tanarid']."</td>";
						echo "<td>".$s['kezdeseve']."/".$s['vegzeseve']." ".$s['omeg']."</td>";
						echo "</tr>";
						
					}
					?>
					</table>

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
