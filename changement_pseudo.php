<?php session_start(); //ouverture de la session
    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];
    $email=$_SESSION["lemail"];
    $password=$_SESSION["lpassword"];

    //Récuperation du dossier usilisateur correspondant au pseudo
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset='uft-8'>
        <title>Paramètres</title>
        <link rel='stylesheet' href='css/main.css'>
        <link rel='stylesheet' href='css/index.css'>
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='css/param.css'>
    </head>
    <nav>
        <img src=/images/cloud.png title='icone' id='icone'>
    </nav>
    <body>
        <div id="wrapper">
            <a href=dashboard.php class='retour'>Retour accueil</a>
            <form method="post">
                    <input type="pseudo" name="new_pseudo" id="new_pseudo" placeholder="Votre nouveau pseudo"><br/>
                    <input type="pseudo" name="newc_pseudo" id="newc_pseudo" placeholder="Confirmer votre nouveau pseudo"><br/>
                    <input type="submit" name="formsend" id="formsend" value="Envoyer"><br/>

            </form>
            

             <?php

                if(isset($_POST['formsend'])){
                    extract($_POST);

                    if(!empty($new_pseudo) && !empty($newc_pseudo)){

                        if($new_pseudo == $newc_pseudo){
                            include 'database.php';
                            global $db;
                            $options = [
                                'cost' => 12,
                            ];
                            
                            $q= $db->prepare("UPDATE users SET pseudo = :pseudo WHERE pseudo = '$pseudo' ");
                            $q->execute([
                            'pseudo'=> $new_pseudo
                            ]);
                            shell_exec("mv users/$pseudo users/$new_pseudo");
                            header('Location: deconnexion.php');
                            echo "<font style=\"font family: courrier new;\"><strong>Le pseudo a été changé merci de vous reconnecter</strong></font>";

                }else{
                    echo "<font style=\"font family: courrier new;\"><strong>Les pseudos ne correspondent pas</strong></font>";
                }

            }else{
                echo "<font style=\"font family: courrier new;\"><strong>Les champs ne sont pas tous remplis</strong></font>";
            }
        }
        ?>
    </div>
    </body>
</html>