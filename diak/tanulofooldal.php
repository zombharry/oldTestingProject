<?php
require '..\kapcsolodas.php';
session_start();

if ( $_SESSION['diakbejelentkezett'] != 1 ) {
  $_SESSION['hibauzenet'] = "Ahhoz hogy megtekintsd ezt az oldalt, előbb be kell jelentkezned!!";
  header("location: ../hiba.php");    
}
$osztalylek="select osztalyid from diakok where oktatasi_azon='".$_SESSION['diak']."'";
$p=$conn->query($osztalylek);
$osztalyid=$p->fetch_assoc();
$o=$osztalyid['osztalyid'];

?>
<!DOCTYPE html>
<html>
<head>
<script src="../jquery-3.3.1.js"></script>
<script src="../jquery_redirect.js"></script>
<!-- https://github.com/mgalante/jquery.redirect/blob/master/jquery.redirect.js    --> 
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<script>
var megjelenitendo="'.grid-kontener , .oldalmenuosztaly, #main, .urlapkinezet, .kozpont, .kijelentkezes'";
$(document).ready(function () {
                $('div').not('#kezdo, .grid-kontener , .oldalmenuosztaly, #main, .urlapkinezet, .kozpont, .kijelentkezes').hide(1000);
            });
			
function megjelenites(tantargy){
	$('div').not('.grid-kontener , .oldalmenuosztaly, #main, .urlapkinezet, .kozpont, .kijelentkezes').hide(1000,function(){
		$(tantargy).show(1000);
	});
            };
	

function kuldes(teszt,oldal){
	$.redirect(oldal,{tesztid:teszt});
	
	
}
</script>
</head>
<body>
<div class="grid-kontener">
  <div id="oldalmenu" class="oldalmenuosztaly">
            <a href="javascript:void(0)" class="bezaroGomb" onclick="menuBezar()">&times;</a>
            <ul>
                <li class="bevittmenupont" id="fooldal" onmousedown='megjelenites("#kezdo")'>Főoldal</li>
				<?php
				
					$sql1="select tanitasok.tantargyid,tantargyak.megnevezes from tantargyak,tanitasok where tanitasok.tantargyid=tantargyak.tantargyid and tanitasok.osztalyid='".$o."'";
					
					$p2=$conn->query($sql1);
					while($tantargy=$p2->fetch_array()){
						
						$tarolo[$tantargy['tantargyid']]=$tantargy;
						?>
						<li class="bevittmenupont kattinthato" id="menu<?=$tantargy['tantargyid']?>" onmousedown='megjelenites("#urlap<?=$tantargy['tantargyid']?>")'>
						<?=$tantargy['megnevezes']?></li>
						
						<?php
						
						
					}
					
					$sql2="select tema,tesztid,megnevezes,tantargyid from tesztek where aktiv=1";
					$parancs3=$conn->query($sql2)or die();
					while($tesztek=$parancs3->fetch_array()){
						$tarolo[$tesztek['tantargyid']]['tesztek'][]=$tesztek;
						
					}
					
				?>
            </ul>

        </div>
<div id="main">
            <span id="kurzor" onclick="menuMegnyit()">&#9776; Menü</span>




        </div>
 <div class="kozpont"><div class="urlapkinezet">
       <div id="kezdo"> <h1>Kezdőlap</h1>
	   
	   <?php if (isset($_SESSION['uzenet']) AND !empty($_SESSION['uzenet'])){
		   echo $_SESSION['uzenet'];   
		   
	   } ?>
	   </div>
	   
	   <?php
	  
	   foreach($tarolo as $tantargyak) {
		   ?>
		   <div id="urlap<?=$tantargyak['tantargyid']?>"><?php 
		  if(!empty($tantargyak['tesztek'])){
		   foreach($tantargyak['tesztek'] as $a){
		  echo $a['tema']; 
		  ?><br> <button onclick='kuldes(<?=$a['tesztid']?>,"teszt.php")'><?=$a['megnevezes']?></button><br><br><?php }}
		   else{
			   echo "Nincsenek megjelenítendő tesztek";
		   
			   
		   }
		   ?> </div>
		   <?php
	   }
			
		
	   ?>
	   
	   
	   
		
        
        <div class='kijelentkezes'>
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
