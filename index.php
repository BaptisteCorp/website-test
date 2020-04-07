<?php session_start(); //ouverture de la session
    if (isset($_SESSION["pseudo"])){
        header('Location: dashboard.php');
    }
?> 

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Homepage</title>
        <meta charset="utf-8"/>
        <!--<link rel="stylesheet" href="css/main.css"/>-->
        <link rel="stylesheet" href="css/index.css"/>
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    </head>

    <nav>
        <a href="inscription.php" id="inscription">Pas de compte ?</a>
    </nav>
    <body>
        <?php
            include 'database.php';
            global $db;
        ?>
        <!-- Affichage page de connexion -->
        <div class="login-content">
                
            <form method="POST" action="index.php">

                <h2 class='title'>Bienvenue</h2>
                <img id="cloudIcone"src="images/cloud.png" />

                <div class="input-div mail">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class='div'>
                        <h5>Email</h5>
                        <input type="email" name="lemail" id="lemail" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class='i'>
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class='div'>
                        <h5>Password</h5>
                        <input type="password" name="lpassword" id="lpassword" class="input">
                    </div>
                </div>
                
                <a href="pwd_forget.php" >Mot de passe oublié ?</a>
                <input type="submit" name="formlogin" id="formlogin" value="Login" class="btn">
                
            </form>
        </div>

        <!-- Verifiactions sur la base de données -->
        <?php 
            if(isset($_POST['formlogin'])){
                extract($_POST);

                if(!empty($lemail) && !empty($lpassword)){

                    $q = $db->prepare("SELECT * FROM users WHERE email = :email");
                    $q->execute(['email' => $lemail]);
                    $result = $q->fetch();

                    if($result == true){
                        //le compte existe bien

                        if(password_verify($lpassword, $result['password'])){
                            echo "Le mot de passe est bon , connexion";
                            $_SESSION["pseudo"]=$result['pseudo']; //permet de récupérer le pseudo de la personne qui se connecte
                            $_SESSION["lemail"]=$result['email'];
                            $_SESSION["lpassword"]=$result['password'];
                            $_SESSION['fileUpload']=False;
                            header('Location: dashboard.php');
                            exit();
                        }else{
                            echo "Le mot de passe est incorrect";
                        }
                    }
                    else{
                        echo "Le compte pourtant l'email " . $lemail . "n'existe pas";
                    }
                }
                else{
                    echo "Veuillez completer l'ensemble des champs";
                }
            }
        ?>
        <script type="text/javascript" src="js/index.js"></script>
    </body>
</html>