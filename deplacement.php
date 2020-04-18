<?php
    session_start(); //ouverture de la session
    $dossier=$_GET['dossier'];
    $fichier=$_GET['fichier'];
    //Récuperation du dossier usilisateur correspondant au pseudo
    $current_dir=$_SESSION['currentDir'];

    shell_exec( "mv $current_dir$fichier $current_dir$dossier");
?>