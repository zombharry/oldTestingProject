<?php
session_start();
require '..\kapcsolodas.php'
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
                <li><a class="active" href="adminfooldal.php">Főoldal</a></li>
				
                <li><a href="diakok.php">Diákok</a></li>
                <li><a href="ujdiak.php">Új diák</a></li>
                <li><a href="#">Osztályok</a></li>
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
                <h1>Osztályok</h1>
				<?php 
				$sql="select * from osztalyok";
				$parancs=$conn->query($sql);
				if($parancs->num_rows==0){
					echo "Jelenleg nincsenek megjelenítendő osztályok!";
				}
				else{
					echo "<table>";
					echo "<tr>";
					echo "<th>id </th>";
					echo "<th>kezdés éve</th>";
					echo "<th>végzés éve</th>";
					echo "<th>megnevezés</th>";
					echo "</tr>";
					while($sor=mysqli_fetch_assoc($parancs)){
						echo "<tr>";
						echo "<td>".$sor['osztalyid']."</td>";
						echo "<td>".$sor['kezdeseve']."</td>";
						echo "<td>".$sor['vegzeseve']."</td>";
						echo "<td>".$sor['megnevezes']."</td>";
						echo "</tr>";
					}
					
					echo "</table>";
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
