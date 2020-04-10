
<?php
    session_start(); //ouverture de la session
    $nom_dossier=$_GET['nom_dossier'];
    $_SESSION["currentDir"]=$_SESSION["currentDir"].$nom_dossier;
?>
