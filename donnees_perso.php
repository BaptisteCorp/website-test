<?php session_start(); //ouverture de la session
    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];
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
    <nav>
        <img src=/images/cloud.png title='icone' id='icone'>
    </nav>
    <body>
        <div id="wrapper">
            <a href=parametres.php class='retour'>Retour</a>
            <h1>Voici les données :</h1>
            <p>
                Pseudo = <?php echo $pseudo ?><br/>
                Email = <?php echo $email ?><br/>
                Mot de passe = <?php echo $password ?>
            </p>
            <button disabled>Changer Pseudo</button><br/>
            <button disabled>Changer mot de passe</button>
            <button disabled>Changer email</button>
            
        </div>

        <dialog id="mdpDialog">
            <button>Shure</button>
            <button id="cancel">Cancel</button>
        </dialog>
        <script type="text/javascript" src="/js/parametres.js"></script>
    </body>
</html>