<?php
    session_start(); 

    if (isset($_GET['dossier'])){ //supression dossier
        $suppDir=$_GET['dossier'];
        $current_dir=$_SESSION['currentDir'];
        shell_exec( "rm -dr $current_dir/$suppDir");

    }else if (isset($_GET['fichier'])){ //suppression fichier
        $suppFile=$_GET['fichier'];
        $current_dir=$_SESSION['currentDir'];
        shell_exec( "rm $current_dir/$suppFile");
    }
?>