<?php
    session_start(); //ouverture de la session
    $chemin=explode('/',$_SESSION["currentDir"]);
    array_splice($chemin,-2);
    if (count($chemin)>1){
        $chemin=implode('/',$chemin).'/';
        $_SESSION["currentDir"]=$chemin;
    }
    header('Location: dashboard.php');
?>