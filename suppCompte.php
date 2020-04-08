<?php session_start(); //ouverture de la session
    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];
    if ($pseudo==""){
        header('Location: index.php');
    }
    //Récuperation du dossier usilisateur correspondant au pseudo
    $current_dir="users/$pseudo";
    shell_exec("rm -dr $current_dir/");
    session_unset();
    session_destroy();
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset='uft-8'>
        <title>Paramètres</title>
        <link rel='stylesheet' href='css/main.css'>
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='css/index.css'>
        <link rel='stylesheet' href='css/param.css'>
    </head>
    <body>
        
        <div id="wrapper">
            <h1>Votre compte a bien été supprimé</h1>
            <a href="index.php">Retour accueil</a>
            
        </div>
        <script type="text/javascript" src="/js/parametres.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
    </body>
</html>