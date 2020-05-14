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
            
    <?php

        if(isset($_POST['formsend'])){
            extract($_POST);

            if(!empty($password) && !empty($cpassword) && !empty($semail)){
                $antiXSSmail = stripos($semail, '<script>');
                $antiXSSpseudo = stripos($pseudo, '<script>');
                $antiXSSmdp = stripos($cpassword, '<script>');
                if($antiXSSmail === false && $antiXSSpseudo === false && $antiXSSmdp === false) { // corrige la faille XSS
                    
                    if( stripos($pseudo, ' ') === false ){

                        if($password == $cpassword){

                            $options = [
                                'cost' => 12,
                            ];

                            $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
                            include 'database.php';
                            global $db;

                            $c = $db->prepare("SELECT email FROM users WHERE email = :email"); //on prend dans la table users les emails
                            $c->execute(['email' => $semail]);

                            $d = $db->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
                            $d->execute(['pseudo' => $pseudo]);

                            $result = $c->rowCount() + $d->rowCount(); //comptage de nombre d'email à ce nom
                            if($result == 0){ //s'il n'y en a aucun
                                $_SESSION['data']=array(0 => $semail, $password, $pseudo);
                                $length=6;
                                $chars = '0123456789'; // Création d'un coce de 6 caractères aléatoires
                                $string = '';

                                for($i=0; $i<$length; $i++){
                                    $string .= $chars[rand(0, strlen($chars)-1)];
                                }
                                $_SESSION['code']=$string;

                                $headers = "CC: webmaster@serviel.com\r\n";
                                $headers .= "MIME-Version: 1.0\r\n";
                                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                                $message = ' 
                                    <html> 
                                    <head> 
                                        <link rel="stylesheet" href="css/index.css"/>
                                        <title>Bienvenue sur votre Cloud</title> 
                                    </head> 
                                    <body> 
                                        <p align="center"><img id="cloudIcone"src="images/cloud.png" /></p>
                                        <h1>Merci de nous rejoindre! Voici votre code de confirmation : $string </h1> 
                                        <table cellspacing="0" style="border: 2px dashed #14fb9f; width: 100%;"> 
                                            
                                            <tr style="background-color: #e0e0e0;"> 
                                                <th>Contact :</th><td>webmaster@serviel.com</td> 
                                            </tr> 
                                            <tr> 
                                                <th>Website:</th><td><a href="serviel.ddns.com:8000"</a></td> 
                                            </tr> 
                                        </table> 
                                    </body> 
                                    </html>'; 
                                                                
                                $success=mail($semail,"Code de confirmation",$message,$headers); // envoi du mail à l'utilisateur
                                if (!$success) {
                                    $errorMessage = error_get_last()['message'];
                                    echo $errorMessage;
                                }
                                else{
                                echo "Un mail vient de vous être envoyé à : ";
                                echo $semail;
                                }
                                ?>
                                <form method="post" class='formjoli'>
                                    <input type="password" name="code" id="code">
                                    <input type="submit" name="formconfirm" id="formconfirm" value="Envoyer">
                                </form>
                                <?php
                                /*
                                $q= $db->prepare("INSERT INTO users(email,password,pseudo,data) VALUES(:email,:password,:pseudo,1)"); //on insere dans la base de données l'email de mot de passe le pseudo et les datas
                                $q->execute([
                                    'email'=> $semail,
                                    'password'=> $hashpass,
                                    'pseudo'=> $pseudo
                                ]);
                                shell_exec("mkdir users/$pseudo/");
                                echo "<font style=\"font family: courrier new;\"><strong>Le compte a été crée</strong></font>";
                                header('Location: index.php');*/
                            }else{
                                echo "<font style=\"font family: courrier new;\"><strong>Un Email ou un pseudo identique existe déjà</strong></font>";
                            }
                        }else{
                            echo "<font style=\"font family: courrier new;\"><strong>Les mot de passes ne correspondent pas</strong></font>";
                        }
                    }else{
                        echo "<font style=\"font family: courrier new;\"><strong>Il ne doit pas y avoir d'espaces dans le pseudo</strong></font>";
                    }
                }else{
                    echo "<font style=\"font family: courrier new;\"><strong>Site protégé contre le XSS</strong></font>";
                }
            }else{
                echo "<font style=\"font family: courrier new;\"><strong>Les champs ne sont pas tous remplis</strong></font>";
            }
        }else if (isset($_POST['formconfirm'])){
            if ($_POST['code']==$_SESSION['code']){
                include 'database.php';
                global $db;

                $pseudo = $_SESSION['data'][2];
                $password = $_SESSION['data'][1];
                $options = [
                    'cost' => 12,
                ];
                $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

                $q= $db->prepare("INSERT INTO users(email,password,pseudo,data) VALUES(:email,:password,:pseudo,1)"); //on insere dans la base de données l'email de mot de passe le pseudo et les datas
                $q->execute([
                    'email'=> $_SESSION['data'][0],
                    'password'=> $hashpass,
                    'pseudo'=> $pseudo
                ]);
                
                shell_exec("mkdir users/$pseudo/");
                echo "<font style=\"font family: courrier new;\"><strong>Le compte a été crée</strong></font>";
                header('Location: index.php');
            }else
            echo "<font style=\"font family: courrier new;\"><strong>Mauvais Code</strong></font>";
        }else{
            ?>
            <form method="post" class='formjoli'>
                    <input type="pseudo" name="pseudo" id="pseudo" placeholder="Votre Pseudo">
                    <input type="email" name="semail" id="semail" placeholder="Votre Email">
                    <input type="password" name="password" id="password" placeholder="Votre  Mot de Passe">
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer le Mot de Passe">
                    <input type="submit" name="formsend" id="formsend" value="Envoyer">

            </form>
            <?php
        }


?>
</div>


<script type="text/javascript" src="/js/main.js"></script>
    </body>
</html>