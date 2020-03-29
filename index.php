<?php session_start(); //ouverture de la session

?> 

<?php
 if(isset($_SESSION['pseudo'])){
?>

  <li id="services"><a href="dashboard.php">Aller sur son Dashboard</a></li>
  <li id="services"><a href="deconnexion.php">Deconnexion</a></li>
<?php                       
 }else{
?>
  <li id="services"><a href="inscription.php">Inscription</a></li>
  <li id="services"><a href="connexion.php">Connexion</a></li>
<?php
 }
?>