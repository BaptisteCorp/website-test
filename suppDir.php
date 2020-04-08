<?php
    session_start(); //ouverture de la session
    $suppDir=$_GET['suppDir'];
    $pseudo=$_SESSION["pseudo"];
    $current_dir="users/$pseudo";
    shell_exec( "rm -dr $current_dir/$suppDir");
?>