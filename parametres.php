<?php session_start(); //ouverture de la session
    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];
    if ($pseudo==""){
        header('Location: index.php');
    }
    //Récuperation du dossier usilisateur correspondant au pseudo
    $current_dir="users/$pseudo";
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
        <img src=/images/cloud.png title='icone' id='icone'>
        <div id="wrapper">
            <a href=dashboard.php class='retour'>Retour accueil</a>
            <a href="donnees_perso.php" class='retour'>Données personnelles</a>
            <button  id="suppButton">Supprimer compte</button>
            <button >Infos stockage</button>
            
        </div>

        <dialog id="suppDialog">
            <h1>Attention, la suppression du compte efface vos données stockées dans le cloud. Voulez-vous continuer ?</h1>
            <button disabled>Oui</button>
            <button id="cancel">Non</button>
        </dialog>
        <script type="text/javascript" src="/js/parametres.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
    </body>
</html>