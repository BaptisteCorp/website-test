<?php session_start(); //ouverture de la session
?> 
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Inscription</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/main.css"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='css/index.css'>
        <link rel='stylesheet' href='css/param.css'>
    </head>
    <nav>
        <img src=/images/cloud.png title='icone' id='icone'>
    </nav>
    <body>
        <div id="wrapper">
            <h2>Attention il ne doit pas y avoir d'espaces !</h2>
            
            <form method="post">
                    <input type="pseudo" name="pseudo" id="pseudo" placeholder="Votre Pseudo">
                    <input type="email" name="semail" id="semail" placeholder="Votre Email">
                    <input type="password" name="password" id="password" placeholder="Votre  Mot de Passe">
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer le Mot de Passe">
                    <input type="submit" name="formsend" id="formsend" value="Envoyer">

            </form>
    <?php

        if(isset($_POST['formsend'])){
            extract($_POST);

            if(!empty($password) && !empty($cpassword) && !empty($semail)){
                $antiXSSmail = stripos($semail, '<script>');
                $antiXSSpseudo = stripos($pseudo, '<script>');
                $antiXSSmdp = stripos($cpassword, '<script>');
                if($antiXSSmail === false && $antiXSSpseudo === false && $antiXSSmdp === false) { // corrige la faille XSS

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
                            $q= $db->prepare("INSERT INTO users(email,password,pseudo,data) VALUES(:email,:password,:pseudo,1)");
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
                    echo "<script>alert(\"Site protégé contre le XSS\")</script>";
                }
            }else{
                echo "<font style=\"font family: courrier new;\"><strong>Les champs ne sont pas tous remplis</strong></font>";
            }
        }


?>
</div>


<script type="text/javascript" src="/js/main.js"></script>
    </body>
</html>