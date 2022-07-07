<?php
session_start();
require '..\kapcsolodas.php';
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
                <li><a href="#">Új diák</a></li>
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
                <h1>Új diák hozzáadása</h1>
				<button id="tobbhoz"> Több diák felvitele filefeltöltéssel</button>
				<button id="egyhez">Egy diák felvitele</button>
				<form action="diakfilefeldolgoz.php" method="post" class="tobb" enctype="multipart/form-data">
				<input type="button" class="vissza" value="&#8592; "> 
				<input type="file" name="diakokfile" id="diakokfile">
				<input type="submit">
				</form>
				<form action="diakfeldolgoz.php" method="post" id='egy'>
				<input type="button" class="vissza" value="&#8592; "> 
				<label for="vnev">Tanuló vezetékneve: </label>
				<input type="text" name="vnev" id="vnev" required>
				<label for="knev">Tanuló keresztneve: </label>
				<input type="text" name="knev" id="knev" required>
				<label for="osztaly">Osztály: </label>
				
				<?php 
				$sql="select osztalyid, megnevezes,kezdeseve,vegzeseve from osztalyok;";
				$parancs=$conn->query($sql);
				if($parancs->num_rows==0){
					?>
					Jelenleg nincsenek osztályok. Osztályok felviteléhez kérem kattintson <a href="ujosztaly.php">ide</a>
					<?php
				}
				else{
					?><select name="osztaly" id="osztaly" required>
					<option value="">-----</option>
					<?php
					while($osztalyok=mysqli_fetch_assoc($parancs)){
						?>
						<option 
						value="<?=$osztalyok['osztalyid']?>" >
						
						<?=$osztalyok['megnevezes']?>
						<?=$osztalyok['kezdeseve']?>/
						<?=$osztalyok['vegzeseve']?>
						</option><?php
					}
				}
				?>
				</select>
				<label for="okazon">Oktatási azonosító: </label>
				<input type="number" name="okazon" id="okazon" required>
				<input type="submit" value="Rögzítés">
				</form>
				

                <div>
                    <a href="kijelentkezes.php"><button class="btn btn-danger gomb" name="logout" >Kijelentkezés</button></a>
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
