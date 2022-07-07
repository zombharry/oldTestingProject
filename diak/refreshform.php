<?php
session_start();
require '..\kapcsolodas.php';

// Az x= a kérdéstípús, a tv= a tanuló válasza, hv=a helyes válasz

function ertekel($x,$tv,$hv){
	$pont=0;
            if ($x==1){
                
                if($tv==$hv){
                    $pont=1;
                }
                
            }
            else if($x==2){
                
                $b=preg_split('/\s+/',$tv); //tanuló válaszát szóközönként daraboljuk
                $c=explode(";",$hv); //a helyes választ pontosvesszőnként daraboljuk
                for($y=0; $y<count($b); $y++){
                    $z=0;
                    while($z<count($c) && $c[$z]!=$b[$y]){
                        $z++;
                    }
                    if($z<count($c)){$pont=1;}
                }
                
            }
            else if($x==3){
				
                 
                if($tv==$hv){
                    $pont=1;
                }
            }
            else if($x==4){ 
			
			$valtozo=0;
			$valtozo2=0;
			
                
                if($tv==$hv){
                    $pont=1;
                }}
           
            
            return $pont;
        }
        

            
            
$helyesvalasz="";
$tipus=$_POST['tipus'];
$valasz2=$_POST['valasz1'];
$diak=$_POST['diak'];

$kerdesid2=$_POST['kerdesid1'];
$sql="SELECT valasz FROM  valaszlehetosegek  WHERE helyes_e=1 and kerdesid=".$kerdesid2;
$lekerd = mysqli_query($conn,$sql);
  
  while ($news = mysqli_fetch_assoc($lekerd)) {
	
  $helyesvalasz +=$news['valasz'].";";}
      
  
 

$elertp=ertekel($tipus,$valasz2,$helyesvalasz);
$diakid;
$sql2="select diakid from diakok where oktatasi_azon=".$diak;
$lek2=$conn->query($sql2);
while($s=mysqli_fetch_assoc($lek2)){
	$diakid=$s['diakid'];
}

 
$par="insert into diakokvalaszai (diakid, kerdesid, diakvalasza, helyes) values ($diakid,$kerdesid2,'$valasz2',$elertp)";
  $query = mysqli_query($conn,$par);
  

?>