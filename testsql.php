<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>test requetes sql sur vdsa</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body background="purple">
<h1 class="titre">Requetes sur montant</h1>
Veuillez selectionner vos personnalisation pour recuperer les données </br>
Whallah si tu choisi rien ton pc va beuger, je te conseille de faire un max de selection ducoup </br></br>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="vdsa";
try{
$conn = new PDO('mysql:host=localhost;dbname=vdsa;charset=utf8', $username, $password);
}
// Check connection
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
} ?>

<form action="/projet/result.php" method="GET">
  <div>
      <label for="Client">Choisis ton client whallah</label>
        <select name="codeclt[]" id="codeclt" multiple>
          <?php
            $clt=$conn->query("SELECT Distinct(codeclt) FROM Client");
            While ($donnees=$clt->fetch())
            {
          ?>
              <option value="<?php echo $donnees['codeclt']; ?>"> <?php echo $donnees['codeclt']; ?></option>
          <?php
            }
          ?>
        </select>
      </br><label for="sousfamille">Choisis ta sousfamille whallah</label>
        <select name="idsfam[]" id="idsfam" multiple >
          <?php
            $sfam=$conn->query("SELECT Distinct(idsfam),libellé FROM sousfamille");
            While ($donnees=$sfam->fetch())
            {
          ?>
              <option value="<?php echo $donnees['idsfam']; ?>"> <?php echo $donnees['libellé']; ?></option>
          <?php
          }
          ?>
        </select>
      </br><label for="temporal">Choisis ton decoupage annuel/mensuel whallah</label>
        <select name="date" id="date">
            <option value="YEAR"> Année</option>
            <option value="MONTH"> Mois</option>
        </select>
  </div>

  <div class="button">
        <button type="submit">Vers l'infini et au dela !</button>
  </div>

</form>
<?php echo "Je m'appelle Kevin et toi ?"; ?>


</body>
</head>
