<?php session_start(); //ouverture de la session
    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];
    if ($pseudo==""){
        header('Location: index.php');
    }
    //Récuperation du dossier usilisateur correspondant au pseudo
    $current_dir="users/$pseudo";

    include 'database.php';
    global $db;
    $donnees=$db->prepare("SELECT data FROM users WHERE pseudo = 'a'");
    $donnees->execute();
    $nbgo = $donnees->fetch();
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
            <h1>Vous avez une offre <?php echo $nbgo[0]?>Go</h1>
            <h2>Voici ce que vous utilisez</h2>
            <p><?php echo explode('users',shell_exec("du -sh users/$pseudo"))[0]."/".$nbgo[0]?>Go</p>
            <?php
            $dataUsed=explode('users',shell_exec("du -s users/$pseudo"))[0];
            $dataUsed=(int)$dataUsed;
            $percent= $dataUsed*100/($nbgo[0]*10**6);
            echo "Soit : ".$percent."%";
            ?>
            <div class="GaugeMeter" id="GaugeMeter_1" data-percent=<?php echo round($percent);?>></div>
            <a href='modifGo.php' id='go'>Plus de Go ?</a>
        </div>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
        <script src="js/GaugeMeter.js" ></script>
        <script>
        $(document).ready(function(){
            $(".GaugeMeter").gaugeMeter();
        });
        </script>
    </body>
</html>