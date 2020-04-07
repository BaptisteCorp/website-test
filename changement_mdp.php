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
    </head>
    <nav>
        <img src=/images/cloud.png title='icone' id='icone'>
    </nav>
    <body>
        <div id="wrapper">
            <form method="post">
                    <input type="password" name="new_password" id="new_password" placeholder="Votre Nouveau Mot de Passe"><br/>
                    <input type="password" name="newc_password" id="newc_password" placeholder="Confirmer Votre Nouveau Mot de Passe"><br/>
                    <input type="submit" name="formsend" id="formsend" value="Envoyer"><br/>

            </form>
            

             <?php

        		if(isset($_POST['formsend'])){
            		extract($_POST);

            		if(!empty($new_password) && !empty($newc_password)){

                		if($new_password == $newc_password){
                			include 'database.php';
    						global $db;

                			$q= $db->prepare("UPDATE users SET password=:password  WHERE pseudo=$pseudo");
                        	$q->execute([
                            'password'=> $new_password
                        	]);
                        	echo "<font style=\"font family: courrier new;\"><strong>Le mdp a été changé merci de vous reconnecter</strong></font>";

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


























        </div>

    </body>
</html>