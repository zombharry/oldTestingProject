<?php
/* Log out process, unsets and destroys session variables */
session_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <script src="../jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
  <title>kijelentkezés</title>

</head>

<body>
    <div class="urlapkinezet">
          <h1>Sikeres kijelentkezés</h1>
              
          
          
          <a href="../index.php"><button class="gomb"/>Főoldal</button></a>

    </div>
</body>
</html>
