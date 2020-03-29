<?php session_start(); //ouverture de la session

?> 
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Inscription</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/main.css"/>
    </head>

    <body>
        <div id="wrapper">
            
            <form method="post">
                    <input type="pseudo" name="pseudo" id="pseudo" placeholder="Votre Pseudo"><br/>
                    <input type="email" name="semail" id="semail" placeholder="Votre Email"><br/>
                    <input type="password" name="password" id="password" placeholder="Votre  Mot de Passe"><br/>
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer Votre Mot de Passe"><br/>
                    <input type="submit" name="formsend" id="formsend" value="Envoyer"><br/>

            </form>
    <?php

        if(isset($_POST['formsend'])){
            extract($_POST);

            if(!empty($password) && !empty($cpassword) && !empty($semail)){

                if($password == $cpassword){

                    $options = [
                        'cost' => 12,
                    ];

                    $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
                    include 'database.php';
                    global $db;

                    $c = $db->prepare("SELECT email FROM users WHERE email = :email"); //on prend dans la table users les emails
                    $c->execute(['email' => $semail]);

                    $result = $c->rowCount(); //comptage de nombre d'email à ce nom
                    if($result == 0){
                        $q= $db->prepare("INSERT INTO users(email,password,pseudo) VALUES(:email,:password,:pseudo)");
                        $q->execute([
                            'email'=> $semail,
                            'password'=> $hashpass,
                            'pseudo'=> $pseudo
                        ]);
                        shell_exec("mkdir users/$pseudo/");
                        echo "<font style=\"font family: courrier new;\"><strong>Le compte a été crée</strong></font>";
                        header('Location: index.php');
                        }else{
                            echo "<font style=\"font family: courrier new;\"><strong>Un Email identique existe déjà</strong></font>";
                        }

                }else{
                    echo "<font style=\"font family: courrier new;\"><strong>Les mot de passes ne correspondent pas</strong></font>";
                }

            }else{
                echo "<font style=\"font family: courrier new;\"><strong>Les champs ne sont pas tous remplis</strong></font>";
            }
        }


?>
</div>



    </body>
</html>