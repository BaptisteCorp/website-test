<?php
    session_start(); //ouverture de la session
    $nom_dossier=$_GET['nom_dossier'];

    //Récuperation du dossier usilisateur correspondant au pseudo
    $current_dir=$_SESSION['currentDir'];

    shell_exec( "mkdir $current_dir$nom_dossier");
?>
