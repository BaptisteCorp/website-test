
<?php
    session_start(); //ouverture de la session
    $nom_dossier=$_GET['nom_dossier'];

    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];

    //Récuperation du dossier usilisateur correspondant au pseudo
    $current_dir="users/$pseudo/";

    shell_exec( "mkdir $current_dir$nom_dossier");
?>
