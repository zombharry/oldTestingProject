<?php
session_start();
require '..\kapcsolodas.php'
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
                <li><a href="#">Tanárok</a></li>
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
                <h1>Tanárok</h1>
				<table>
				<tr>
				<th>id</th>
				<th>név</th>
				<th>felhasználónév</th>
				</tr>
				<?php 
				$sql="select tanarid,vezeteknev, keresztnev,felhasznalonev from tanar";
				$vegrehajtas=$conn->query($sql);
				while($sor=mysqli_fetch_assoc($vegrehajtas)){
					?> <tr class="kattinthato" onmousedown="$.redirect('tanarbovebben.php',{tanarid:<?php echo $sor['tanarid']?>})"> <?php
					echo "<td>".$sor['tanarid']."</td>";
					echo "<td>".$sor['vezeteknev']." ". $sor['keresztnev']."</td>";
					echo "<td>".$sor['felhasznalonev']."</td>";
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
