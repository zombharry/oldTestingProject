<?php

require '..\kapcsolodas.php';
session_start();
$felhasznalo=$_SESSION['admin'];
$teszt=$_POST['tesztid'];


if ($_SESSION['adminbejelentkezett'] != 1) {
    $_SESSION['message'] = "Ahhoz hogy megtekintsd ezt az oldalt, előbb be kell jelentkezned!!";
    header("location: ..\error.php");
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
<html lang="hu-HU">
    <head>
        <meta charset="UTF-8">
        <title>tesztek</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <script src="../jquery-3.3.1.js"></script>
<script src="../jquery_redirect.js"></script>
		<!-- https://github.com/mgalante/jquery.redirect/blob/master/jquery.redirect.js    --> 
        <script>
		function kuldes(kerdes,oldal){
	$.redirect(oldal,{kerdesid:kerdes});
	
	
}</script>
       
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
	<input type="button" onclick='kuldes("<?php echo $teszt;?>","ujkerdes.php")' value='Új kérdés'> 
	

        <?php
$sqles = "SELECT tipus,kerdes,szoveg,kerdesid,szovegkep,kerdeskep FROM kerdesek WHERE tesztid=$teszt";
					
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
				<p><?php echo $kerdes['szoveg']?></p>
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
					if($v['helyes_e']==1){
						echo '✔';
					}
					if(!empty($v['kep'])){
						?>
						<img src="..\kepek\<?php echo $v['kep']?>"><br>
						<?php
					}else{
						echo "<br>";
					}
				}
				?>
				<input type="button" value="Szerkesztés" onclick="kuldes(<?php echo $kerdes['kerdesid']?>,'kerdesmodosit.php')">
				</form>
				</div>
				<?php
				}
				//szöveg
             elseif($kerdes['tipus']==2) {
                ?>
                <div name="kerdes<?php echo $row?>" id="kerdes<?php echo $row?>" class="mind">
				
                    <form class="urlapkinezet" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
                        <p><?php echo $kerdes['szoveg']?></p>
				<?php if(!empty($kerdes['szovegkep'])){
					?> <img src="../kepek/<?php echo $kerdes['szovegkep']?>"> <?php
				}?>
				<p><?php echo $kerdes['kerdes']?></p>
				<?php if(!empty($kerdes['kerdeskep'])){
					?> <img src="../kepek/<?php echo $kerdes['kerdeskep']?>"> <?php
				}
				?>
				<input type="text" name="k<?php echo $kerdes['kerdesid']?>" id="k<?php echo $kerdes['kerdesid']?>">
                     <?php 
					 foreach($kerdes['valasz'] as $v){
						 if($v['helyes_e']==1){
							 echo $v['valasz']." ";
						 }
						 
					 }
					 
					 ?>      
<input type="button" value="Szerkesztés" onclick="kuldes(<?php echo $kerdes['kerdesid']?>,'kerdesmodosit.php')">
                    </form>
                </div>
                <?php
				
				//checkbox
            } elseif ($kerdes['tipus']==3) {
                ?>
                <div name="kerdes<?php echo $row?>" id="kerdes<?php echo $row?>">
				<form class="urlapkinezet" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
				<p><?php echo $kerdes['szoveg']?></p>
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
					if($v['helyes_e']==1){
						echo '✔';
					}
					if(!empty($v['kep'])){
						?>
						<img src="..\kepek\<?php echo $v['kep']?>"><br>
						<?php
					}else{
						echo "<br>";
					}
					
				}
				
				?>
				 <input type="button" value="Szerkesztés" onclick="kuldes(<?php echo $kerdes['kerdesid']?>,'kerdesmodosit.php')">
				</form>
				</div>
				

                <?php
            } elseif ($kerdes['tipus']==4) {

//-------------------------------LEGÖRDÜLŐ MENÜ --------------------------
                ?>
                <div name="kerdes<?php echo $row?>" id="kerdes<?php echo $row?>">
				<form class="urlapkinezet" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
				<p><?php echo $kerdes['szoveg']?></p>
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
					
					<option  value="<?php echo $v['valasz']?>" ><?php echo $v['valasz']; if($v['helyes_e']==1){
						echo '✔';
					}?></option>
					
					<?php
					
					
				}
				?>
				</select>
				<input type="button" value="Szerkesztés" onclick="kuldes(<?php echo $kerdes['kerdesid']?>,'kerdesmodosit.php')">
				</form>
			
                </div>
                <?php
            };
	$row++;
			};

                ?> 
                
                </body>
                </html>
