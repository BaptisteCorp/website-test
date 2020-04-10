<?php
    session_start(); //ouverture de la session
    $suppFile=$_GET['suppFile'];
    $current_dir=$_SESSION['currentDir'];
    shell_exec( "rm $current_dir/$suppFile");
?>