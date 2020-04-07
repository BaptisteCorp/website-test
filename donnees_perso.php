<?php session_start(); //ouverture de la session
    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];
    include 'database.php';
    global $db;
    $email=$_SESSION["lemail"];
    $password=$_SESSION["lpassword"];
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
        <link rel='stylesheet' href='css/index.css'>
    </head>
    <body>
        <img src=/images/cloud.png title='icone' id='icone'>
        <div id="wrapper">
            <a href=parametres.php class='retour'>Retour</a>
            <h1>Voici les données :</h1>
            <p>
                Pseudo = <?php echo $pseudo ?><br/>
                Email = <?php echo $email ?><br/>
                Mot de passe = <?php echo $password ?>
            </p>
            <button disabled>Changer Pseudo</button><br/>
            <form action="changement_mdp.php" method="get" target="_blank">
            <button type="submit">Changer de mdp</button>
            </form>
            <button disabled>Changer email</button>
            
        </div>

        <dialog id="mdpDialog">
            <button>Shure</button>
            <button id="cancel">Cancel</button>
        </dialog>
        <script type="text/javascript" src="/js/main.js"></script>
    </body>
</html>