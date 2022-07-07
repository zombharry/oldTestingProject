<?php

require '..\kapcsolodas.php';
session_start();
error_reporting(0);
$felhasznalo=$_SESSION['diak'];
$teszt=$_POST['tesztid'];


if ($_SESSION['diakbejelentkezett'] != 1) {
    $_SESSION['message'] = "Ahhoz hogy megtekintsd ezt az oldalt, előbb be kell jelentkezned!!";
    header("location: ..\error.php");
}


   $kitoltotte = "SELECT dv.diakid FROM diakokvalaszai dv, diakok d, kerdesek k where dv.diakid=d.diakid and d.oktatasi_azon like '".$felhasznalo."' and dv.kerdesid=k.kerdesid and k.tesztid=$teszt ";
        $engedely = mysqli_query($conn, $kitoltotte);
        if(mysqli_num_rows($engedely)>=1){
             $_SESSION['uzenet'] = "Ezt a tesztet már kitöltötted";
    header("location: tanulofooldal.php");

        } 
		


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
<html lang="hu-HU">
    <head>
        <meta charset="UTF-8">
        <title>teszt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <script src="../jquery-3.3.1.js"></script>
<script src="../jquery_redirect.js"></script>
		<!-- https://github.com/mgalante/jquery.redirect/blob/master/jquery.redirect.js    --> 
        <script>$(document).ready(function () {
                $('div').not('#kerdes0').hide();
            });
<!------------------------RADIO GOMBOT FELDOLGOZÓ SCRIPT KEZDETE----------------------------------------------->
			function radiokuld(felhasznalo,kerdesid,valasznevek,kovetkezo){
                                    
                                    var t=1;
                                    var valasz = $("input[name="+valasznevek+" ]:checked").val();
                                    if(valasz==""){alert("Kérlek válaszolj a kérdésre!")}
else{
	
                                    $.post("refreshform.php", {diak: felhasznalo, kerdesid1: kerdesid, valasz1: valasz,tipus:t},
                                            function (data) {
                                                
                                                    $('div').hide(1000, function () {
                                                        $(kovetkezo).show(1000);
                                                    });
                                                
                                            });
											valasz=null;
						};}
<!------------------------RÁDIÓ GOMBOT FELDOLGOZÓ SCRIPT VÉGE----------------------------------------------->   

<!------------------------SZÖVEGET FELDOLGOZÓ SCRIPT KEZDETE------------------------------------------------>   
function szovegkuld(felhasznalo,kerdesid,valasznevek,kovetkezo){
                                    
                                    var t=2;
                                    var valasz = $("input[name="+valasznevek+"]").val();
                                    if(valasz==""){alert("Kérlek válaszolj a kérdésre!")}else{
										
										
                                    $.post("refreshform.php", {diak: felhasznalo, kerdesid1: kerdesid, valasz1: valasz,tipus:t},
                                            function (data) {
                                                
                                                    $('div').hide(1000, function () {
                                                        $(kovetkezo).show(1000);
                                                    });
                                                
                                            });
											
											valasz=null;
						};}
						
<!------------------------SZÖVEGET FELDOLGOZÓ SCRIPT VÉGE------------------------------------------------>   

<!------------------------CHECKBOXOT FELDOLGOZÓ SCRIPT KEZDETE----------------------------------------------->

					
					function checkboxkuld(felhasznalo,kerdesid,valasznevek,kovetkezo){
                                    var t=3;
									var valaszok = [];
                                $("input[name='"+valasznevek+"']:checked").each(function () {
                                    valaszok.push($(this).val());
                                });
                                var valasz;
                                valasz = valaszok.join(';');
								
                                   
                                    if(valasz.length > 0){ 
										
										$.post("refreshform.php", {diak: felhasznalo, kerdesid1: kerdesid, valasz1: valasz,tipus:t},
                                            function (data) {
                                                
                                                    $('div').hide(1000, function () {
                                                        $(kovetkezo).show(1000);
                                                    });
													})
									
									valasz=null;
									}
									else{alert("Kérlek válaszolj a kérdésre!")}
					}


<!------------------------CHECKBOXOT FELDOLGOZÓ SCRIPT VÉGE----------------------------------------------->
<!------------------------LEGÖRDÜLŐ MENÜ FELDOLGOZÓ SCRIPT KEZDETE----------------------------------------------->
                       
						function legordulokuld(felhasznalo,kerdesid,valasznevek,kovetkezo){
                                    
                                    var t=4;
                                    var valasz = $("select[name="+valasznevek+"] :selected").val();
                                    if(valasz==""){alert("Kérlek válaszolj a kérdésre!")}else{
										
										
                                    $.post("refreshform.php", {diak: felhasznalo, kerdesid1: kerdesid, valasz1: valasz,tipus:t},
                                            function (data) {
                                                
                                                    $('div').hide(1000, function () {
                                                        $(kovetkezo).show(1000);
                                                    });
                                                
                                            });
											
											valasz=null;
						};}


<!------------------------LEGÖRDÜLŐ MENÜ FELDOLGOZÓ SCRIPT VÉGE----------------------------------------------->
					
			
			
			</script> 
       
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>

        <?php
$sqles = "SELECT tipus,kerdes,szoveg,kerdesid,szovegkep,kerdeskep FROM kerdesek WHERE tesztid='$teszt' order by rand()";
					
					$p2=$conn->query($sqles)or die('hiba');
					while($kerdes=$p2->fetch_array()){
						
					$kerdeslista[$kerdes['kerdesid']]=$kerdes;}
					
					$sql2="select * from valaszlehetosegek";
					$parancs3=$conn->query($sql2)or die();
					while($valaszok=$parancs3->fetch_array()){
						$kerdeslista[$valaszok['kerdesid']]['valasz'][]=$valaszok;
						
					}
					
		
		



        $ossz = mysqli_num_rows($p2);

$row=0;
        
			foreach($kerdeslista as $kerdes){
				//Radio gomb
				if($kerdes['tipus']==1){
				?>
				
				<div name="kerdes<?php echo $row?>" id="kerdes<?php echo $row?>">
				<form class="urlapkinezet" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
				<p><?php 
				
				echo $kerdes['szoveg']?></p>
				<?php if(!empty($kerdes['szovegkep'])){
					?> <img src="../kepek/<?php echo $kerdes['szovegkep']?>"> <?php
				}?>
				<p><?php echo $kerdes['kerdes']?></p>
				<?php if(!empty($kerdes['kerdeskep'])){
					?> <img src="../kepek/<?php echo $kerdes['kerdeskep']?>"> <?php
				}
				?>
				<input type="radio" class="semmi" value="" name="k<?php echo $kerdes['kerdesid']?>" checked="checked">
				<?php
				foreach($kerdes['valasz'] as $v){
					 echo $v['valasz'];?>
					<input type="radio" value="<?php echo $v['valasz']?>" name="k<?php echo $kerdes['kerdesid']?>" id="k<?php echo $kerdes['kerdesid']?>">
					<?php
					if(!empty($v['kep'])){
						?>
						<img src="..\kepek\<?php echo $v['kep']?>"><br>
						<?php
					}else{
						echo "<br>";
					}
				}
				
				?>
				
				 <input type="button" id="submit<?php echo $row ?>" value="tovább ->>" onclick="radiokuld('<?php echo $felhasznalo?>','<?php echo $kerdes['kerdesid'] ?>','k<?php echo $kerdes['kerdesid']?>','#kerdes<?php echo $row*1+1 ?>')" />
				</form>
				</div>
				<?php
				}
				//szöveg
             elseif($kerdes['tipus']==2) {
                ?>
                <div name="kerdes<?php echo $row?>" id="kerdes<?php echo $row?>" class="mind">
				
                    <form class="urlapkinezet" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
                        <p><?php

						echo $kerdes['szoveg']?></p>
				<?php if(!empty($kerdes['szovegkep'])){
					?> <img src="../kepek/<?php echo $kerdes['szovegkep']?>"> <?php
				}?>
				<p><?php echo $kerdes['kerdes']?></p>
				<?php if(!empty($kerdes['kerdeskep'])){
					?> <img src="../kepek/<?php echo $kerdes['kerdeskep']?>"> <?php
				}
				?>
				<input type="text" name="k<?php echo $kerdes['kerdesid']?>" id="k<?php echo $kerdes['kerdesid']?>">
                            <input type="button" id="submit<?php echo $row ?>" value="tovább ->>" onclick="szovegkuld('<?php echo $felhasznalo?>','<?php echo $kerdes['kerdesid']?>','k<?php echo $kerdes['kerdesid']?>','#kerdes<?php echo $row*1+1?>')">

                    </form>
                </div>
                <?php
				
				//checkbox
            } elseif ($kerdes['tipus']==3) {
                ?>
                <div name="kerdes<?php echo $row?>" id="kerdes<?php echo $row?>">
				<form class="urlapkinezet" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
				<p><?php

				echo $kerdes['szoveg']?></p>
				<?php if(!empty($kerdes['szovegkep'])){
					?> <img src="../kepek/<?php echo $kerdes['szovegkep']?>"> <?php
				}?>
				<p><?php echo $kerdes['kerdes']?></p>
				<?php if(!empty($kerdes['kerdeskep'])){
					?> <img src="../kepek/<?php echo $kerdes['kerdeskep']?>"> <?php
				}
				
				foreach($kerdes['valasz'] as $v){
					 echo $v['valasz'];?>
					<input type="checkbox" value="<?php echo $v['valasz']?>" name="k<?php echo $kerdes['kerdesid']?>[]" id="k<?php echo $kerdes['kerdesid']?>">
					<?php
					if(!empty($v['kep'])){
						?>
						<img src="..\kepek\<?php echo $v['kep']?>"><br>
						<?php
					}else{
						echo "<br>";
					}
				}
				?>
				 <input type="button" id="submit<?php echo $row ?>" value="tovább ->>" onclick="checkboxkuld('<?php echo $felhasznalo?>','<?php echo $kerdes['kerdesid']?>','k<?php echo $kerdes['kerdesid']?>[]','#kerdes<?php echo $row*1+1?>')" />
				</form>
				</div>
				

                <?php
            } elseif ($kerdes['tipus']==4) {

//-------------------------------LEGÖRDÜLŐ MENÜ --------------------------
                ?>
                <div name="kerdes<?php echo $row?>" id="kerdes<?php echo $row?>">
				<form class="urlapkinezet" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
				<p><?php 
				
				echo $kerdes['szoveg']?></p>
				<?php if(!empty($kerdes['szovegkep'])){
					?> <img src="../kepek/<?php echo $kerdes['szovegkep']?>"> <?php
				}?>
				<p><?php echo $kerdes['kerdes']?></p>
				<?php if(!empty($kerdes['kerdeskep'])){
					?> <img src="../kepek/<?php echo $kerdes['kerdeskep']?>"> <?php
				}
				?>
				<select name="k<?php echo $kerdes['kerdesid']?>" id="k<?php echo $kerdes['kerdesid']?>">
				<option  value="" >Válaszd ki a megfelelőt</option>
				<?php
				
				foreach($kerdes['valasz'] as $v){
					?>
					
					<option  value="<?php echo $v['valasz']?>" ><?php echo $v['valasz']?></option>
					<?php
					
				}
				?>
				</select>
				 <input type="button" id="submit<?php echo $row ?>" value="tovább ->>" onclick="legordulokuld('<?php echo $felhasznalo?>','<?php echo $kerdes['kerdesid']?>','k<?php echo $kerdes['kerdesid']?>','#kerdes<?php echo $row*1+1?>')" />
				</form>
			
                </div>
                <?php
            };
	$row++;
			};

                ?> 
                <div id="kerdes<?php echo $ossz ?>"  class="urlapkinezet">
                    <form action="tanulofooldal.php">
                        <h1>Sikeres teszt kitöltés! </h1>
                        <input type="submit" value="VISSZATÉRÉS A FŐOLDALRA!">
                    </form>

                </div>
                </body>
                </html>
