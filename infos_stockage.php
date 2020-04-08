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
            <a href="parametres.php">Retour</a>
            <h1>Voici ce que vous utilisez</h1>
            <p><?php echo explode('users',shell_exec("du -sh users/$pseudo"))[0]?>/1Go</p>
            <div class="GaugeMeter" id="GaugeMeter_1" data-percent="10"></div>
            
        </div>
        <script src="js/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
        <script src="js/GaugeMeter.js"></script>
        <script>
        $(document).ready(function(){
            $(".GaugeMeter").gaugeMeter();
        });
        </script>
    </body>
</html>