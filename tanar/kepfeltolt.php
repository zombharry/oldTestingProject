<?php
require '..\kapcsolodas.php';


session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$target_dir = "../kepek/";
$target_file = $target_dir . basename($_FILES["filefeltolt"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$uzenet="";
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["filefeltolt"]["tmp_name"]);
    if($check !== false) {
        $uzenet="A file kép";
        $uploadOk = 1;
    } else {
        $uzenet="A file nem kép";
        $uploadOk = 0;
    }
    }
    if (file_exists($target_file)) {
    $uzenet= "A kép már létezik";
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uzenet= "Csak JPG, JPEG, PNG & GIF formátumú képeket lehet feltölteni.";
    $uploadOk = 0;
}
if($uploadOk == 1) {
    if (move_uploaded_file($_FILES["filefeltolt"]["tmp_name"], $target_file)) {
        $kepnev="".basename( $_FILES["filefeltolt"]["name"]);
        $uzenet= "A ". $kepnev. " képet sikeresen feltöltötted";
        $lekerdszoveg="insert into kepek(kepnev) values('$kepnev')";
        $conn->query($lekerdszoveg);
        
        
    } else {
        $uzenet= "Hiba történt a képfeltöltés közben";
    }
}
?>


<html>

 <head>
   <title> ujkepfeltoltes </title>
   <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
 </head>

 <body>
  
    <h1><?=$uzenet?></h1>
    
    <br>

    <form>
     <button><a href="ujkerdes.php">Új kérdés felvétele</a></button>
	 <button><a href="ujkepek.php">Új kép felvétele</a></button>			
	 <button><a href="admin.php">Vissza az admin felületre</a></button>
	 </form>

    <br><br>
    

    


 </body>


</html>
