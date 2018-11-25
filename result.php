<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>test</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="vdsa";

// Create connection
try{
$conn = new PDO('mysql:host=localhost;dbname=vdsa;charset=utf8', $username, $password);
}
// Check connection
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$idsfam=$_GET["idsfam"];
$codeclt=$_GET["codeclt"];
$date=$_GET["date"];
$txtidsfam="idsfam=";
$txtcodeclt="codeclt=";

foreach($_GET["idsfam"] as $valeur)
{
  $txtidsfam="{$txtidsfam}'{$valeur}' OR idsfam=";
}
$txtidsfam=substr($txtidsfam,0,strlen($txtidsfam)-10);
echo $txtidsfam;

foreach($_GET["codeclt"] as $valeur)
{
  $txtcodeclt="{$txtcodeclt}'{$valeur}' OR codeclt=";
}
$txtcodeclt=substr($txtcodeclt,0,strlen($txtcodeclt)-11);
echo $txtcodeclt;


$sql="SELECT idsfam, codeclt, round(sum(vte_fact),2) as chiffre,
MONTH(datedoc) as MONTH, YEAR(datedoc) as YEAR from ventes
Where ({$txtcodeclt}) and ({$txtidsfam})
group by codeclt, idsfam, {$date}";  //requete orienté representant, avec selection client et sousfamille
// rajouter clause where coderep

?> sousfamille | codeclt | CA | Mois | Année </br> <?php
$result=$conn->query($sql);
While ($donnee=$result->fetch()){
  echo $donnee["idsfam"];?> |<?php
  echo $donnee["codeclt"];?> |<?php
  echo $donnee["chiffre"];?> |<?php
  echo $donnee["MONTH"];?> |<?php
  echo $donnee["YEAR"]. '<br />';
}
$result=$conn->query($sql);
$json=json_encode($result->fetchall(PDO::FETCH_ASSOC));
var_dump(json_decode($json));


$result->closeCursor();
?>

</body>
</html>
