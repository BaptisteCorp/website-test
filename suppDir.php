<?php
    session_start(); //ouverture de la session
    $suppDir=$_GET['suppDir'];
    $current_dir=$_SESSION['currentDir'];
    shell_exec( "rm -dr $current_dir/$suppDir");
?>