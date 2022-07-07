<?php 
require 'kapcsolodas.php';
?>

<!DOCTYPE html>

<html>
<head>
  <title>bejeletkezés</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script>

var belepo = document.getElementById('belepo1');

window.onclick = function(event) {
    if (event.target == 'adminbelep') {
        modal.style.display = "none";
    }
}
var belepo = document.getElementById('belepo2');

window.onclick = function(event) {
    if (event.target == 'adminbelep') {
        modal.style.display = "none";
    }
}
var belepo = document.getElementById('belepo3');

window.onclick = function(event) {
    if (event.target == 'adminbelep') {
        modal.style.display = "none";
    }
}
</script>

        
</head>

<body>
  <div class="urlapkinezet">
      
      

<button class="gomb1" onclick="document.getElementById('belepo1').style.display='block'">Belépés Diákként</button>
<div id="belepo1" class="adminbelep">
  
  <form class="tarolo-tartalom animacio" action="diakbelep.php" method="post">
    
      <span onclick="document.getElementById('belepo1').style.display='none'" class="close" title="Bezárás">&times;</span>
      
    

    <div class="tarolo">
      <label for="oktazon"><b>Oktatási azonosító</b></label>
      <input type="text" placeholder="Oktatási azonosító" name="oktazon" required>

      <label for="djelszo"><b>Jelszó</b></label>
      <input type="password" placeholder="Jelszó" name="djelszo" required>
        
      <button type="submit" class="gomb2">Belépés Diákként</button>
      
    </div>

    <div class="tarolo" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('belepo1').style.display='none'" class="megsegomb">Mégse</button>
     
    </div>
  </form>
</div>

<button class="gomb1" onclick="document.getElementById('belepo2').style.display='block'">Belépés Tanárként</button>
<div id="belepo2" class="adminbelep">
  
  <form class="tarolo-tartalom animacio" action="tanarbelep.php" method="post">
    
      <span onclick="document.getElementById('belepo2').style.display='none'" class="close" title="Bezárás">&times;</span>
      
    

    <div class="tarolo">
      <label for="tfelhasznalo"><b>Felhasználó</b></label>
      <input type="text" placeholder="Felhasználó név" name="tfelhasznalo" required>

      <label for="tjelszo"><b>Jelszó</b></label>
      <input type="password" placeholder="Jelszó" name="tjelszo" required>
        
      <button type="submit" class="gomb2">Belépés Tanárként</button>
      
    </div>

    <div class="tarolo" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('belepo2').style.display='none'" class="megsegomb">Mégse</button>
     
    </div>
  </form>
</div>

<button class="gomb1" onclick="document.getElementById('belepo3').style.display='block'">Belépés Adminisztrátorként</button> 
<div id="belepo3" class="adminbelep">
  
  <form class="tarolo-tartalom animacio" action="adminbelep.php" method="post">
    
      <span onclick="document.getElementById('belepo3').style.display='none'" class="close" title="Bezárás">&times;</span>
      
    

    <div class="tarolo">
      <label for="afelhasznalo"><b>Felhasználó</b></label>
      <input type="text" placeholder="Felhasználó név" name="afelhasznalo" id="afelhasznalo" required>

      <label for="ajelszo"><b>Jelszó</b></label>
      <input type="password" placeholder="Jelszó" name="ajelszo" id="ajelszo" required>
        
      <button type="submit" class="gomb2">Belépés Adminisztrátorként</button>
      
    </div>

    <div class="tarolo" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('belepo3').style.display='none'" class="megsegomb">Mégse</button>
     
    </div>
  </form>
</div>

  </div>

</body>
</html>

