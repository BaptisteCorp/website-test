<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Inscription</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div id="wrapper">
            
            <form method="post">
                    <input type="pseudo" name="pseudo" id="pseudo" placeholder="Votre Pseudo"><br/>
                    <input type="email" name="email" id="email" placeholder="Votre Email"><br/>
                    <input type="password" name="password" id="password" placeholder="Votre  Mot de Passe"><br/>
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer Votre Mot de Passe"><br/>
                    <input type="submit" name="formsend" id="formsend" value="Envoyer"><br/>

            </form>
        <?php
    $ip = gethostbyname('serviel.ddns.net:7000');

    echo $ip;
    ?>
    <?php

        if(isset($_POST['formsend'])){
            extract($_POST);

            if(!empty($password) && !empty($cpassword) && !empty($email)){

                if($password == $cpassword){

                    $options = [
                        'cost' => 12,
                    ];

                    $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);
                    include 'database.php';
                    global $db;

                    $q= $db->prepare("INSERT INTO users(email,password,pseudo) VALUES(:email,:password,:pseudo)");
                    $q->execute([
                        'email'=> $email,
                        'password'=> $hashpass,
                        'pseudo'=> $pseudo
                    ]);


                }else{
                    echo "<font style=\"font family: courrier new;\"><strong>Les mot de passes ne correspondent pas</strong></font>";
                }

            }else{
                echo "<font style=\"font family: courrier new;\"><strong>Les champs ne sont pas tous remplies</strong></font>";
            }
        }


?>
</div>



    </body>
</html>