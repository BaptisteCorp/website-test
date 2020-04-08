<?php
    session_start(); //ouverture de la session
    $suppFile=$_GET['suppFile'];
    $pseudo=$_SESSION["pseudo"];
    $current_dir="users/$pseudo";
    shell_exec( "rm $current_dir/$suppFile");
?>