<?php
session_start();
require '..\kapcsolodas.php'
?>
<!DOCTYPE html>
<html>

<head>
<script src="../jquery-3.3.1.js"></script>
     <link rel="stylesheet" type="text/css" href="../css/style.css">
	 <meta charset="UTF-8">
<script>

$(document).ready(function(){
	$("#osztaly").change(function(){
		var osztaly=$(this).val();
		if(osztaly!=""){
			$.ajax({
				type:'POST',
				url:'ajaxmiatt.php',
				data:{osztaly:osztaly},
				succes:function(data){
					$('#ttargy').html(data);
				}
				
			});
		}else{
			$("#ttargy").html("<option value=''>Nincs osztály kiválasztva</option>");
		}
	});
});
</script>

</head>

<body>
    <div class="grid-kontener">
        <div id="oldalmenu" class="oldalmenuosztaly">
            <a href="javascript:void(0)" class="bezaroGomb" onclick="menuBezar()">&times;</a>
            <ul>
                <li><a class="active" href="#">Főoldal</a></li>
                <li><a href="diakok.php">Diákok</a></li>
                <li><a href="osztalyok.php">Osztályok</a></li>
                <li><a href="tanarok.php">Tanárok</a></li>
                <li><a href="tantargyak.php">Tantárgyak</a></li>
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
                
				
				<form id='tesztnev' action="ujkerdes.html">
				<h1>Új teszt</h1>
				<label for="tname">Teszt neve</label>
				<input type="text" name="tname" id="tname">
				<label for="osztaly">Osztály</label>
				<select name="osztaly" id="osztaly">
				<?php 
				
				$sql1="select * from osztalyok";
				$parancs1=$conn->query($sql1);
				$osszegzo=$parancs1->num_rows;
				if($osszegzo>0){
					echo "<option value=''>---------------</option>";
				while ($sor=mysqli_fetch_assoc($parancs1)){
					
					?><option value="<?=$sor['osztalyid']?>"><?=$sor['megnevezes']." ".$sor['kezdeseve']."/".$sor['vegzeseve']?></option>
					<?php
					}
				}else{
							echo "<option value=''>Nincsenek osztályok</option>";
						
					
				}
				
				?>
				
				</select>
				
				<label for="ttargy">Tantárgy</label>
				<select name="ttargy" id="ttargy">
				<option>Nincs osztály kiválasztva</option>
				
				</select>
				<input type="submit" value="Tovább" name="elso" id="elso">
				
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
