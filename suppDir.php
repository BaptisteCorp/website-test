<?php
    session_start(); //ouverture de la session
    $suppDir=$_GET['suppDir'];
    shell_exec( "rm -dr $suppDir");
?>