<?php
    session_start(); //ouverture de la session
    $suppFile=$_GET['suppFile'];
    shell_exec( "rm $suppFile");
?>