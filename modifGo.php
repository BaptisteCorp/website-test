<?php session_start(); //ouverture de la session
    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];
    if ($pseudo==""){
        header('Location: index.php');
    }
    //Récuperation du dossier usilisateur correspondant au pseudo
    $current_dir="users/$pseudo";
    if ( !empty($_POST["nbGo"]) && !empty($_POST["motif"]) ){
        $nbGo=$_POST["nbGo"];
        $motif=$_POST["motif"];
        $success=mail("vielp@hotmail.fr","Demande + de stockage","$pseudo demande $nbGo Go supplementaires \nRaison : $motif",'From: webmaster@serviel.com');
        if (!$success) {
            $errorMessage = error_get_last()['message'];
            echo $errorMessage;
        }
        else{
            echo "Mail envoyé ;)";
        }
        ?>
        <html>
	        </br>
	        <a href="infos_stockage.php">Retour</a>
        </html>
    <?php
    }
    else{
        
    
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
            <a href="parametres.php">Retour</a>
            <h2>Formulaire de demande d'augmentation du stockage</h2>
            <form action="modifGo.php" method='post'>
                <input type='number'    name='nbGo'     min="0" placeholder='Nombre de Go'/>
                <input type='text'      name='motif'    required    placeholder="motif"/>
                <input type="submit"    name='envoi'    value="Envoyer"/>
                <input type="hidden" value="pseudo"/>
            </form>
        </div>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
    </body>
</html>
<?php } ?>