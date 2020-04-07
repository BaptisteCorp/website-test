
<?php
    session_start(); //ouverture de la session
    $nom_dossier=$_GET['nom_dossier'];

    //Récuperation du pseudo
    $_SESSION["pseudo"]=$_SESSION["pseudo"].$nom_dossier

    //Récuperation du dossier usilisateur correspondant au pseudo
?>
