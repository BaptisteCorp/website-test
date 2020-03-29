<?php session_start(); //ouverture de la session

?> 

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Homepage</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
<?php
    include 'database.php';
    global $db;
?>
        <div id="wrapper">
            
            <h1>Bienvenue dans votre cloud</h1>
            <img id="cloud"src="images/cloud.png" alt="icone cloud" title="cloud"/>
            
            <form method="POST" action="index.php">
                <p>
                    <input type="email" name="lemail" id="lemail" placeholder="Email">
                    <br/>
                    <input type="password" name="lpassword" id="lpassword" placeholder="Password">
                    <br/>
                    <input type="submit" name="formlogin" id="formlogin" value="Login" >
                    <br/>
                    <a href="inscription.php">Sign up</a>
                    <a href="pwd_forget.php">Password forget ?</a>
                </p>
             </form>

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
                        $_SESSION["pseudo"]=$result['pseudo'];
                        header('Location: dashboard.php');
                        exit();
                    }else{
                        echo "Le mot de passe est incorrecte";
                    }
                }
                else{
                    echo "Le compte portant l'email " . $lemail . "n'existe pas";
                }
            }
            else{
                echo "Veuillez completer l'ensemble des champs";
            }
        }





    ?>








        </div>
    </body>
</html>