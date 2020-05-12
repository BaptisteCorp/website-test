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
        	<a href=donnees_perso.php class='retour'>Retour</a>
            <form method="post" class='formjoli'>
                    <input type="password" name="new_password" id="new_password" placeholder="Votre Nouveau Mot de Passe"><br/>
                    <input type="password" name="newc_password" id="newc_password" placeholder="Confirmer Votre Nouveau Mot de Passe"><br/>
                    <input type="submit" name="formsend" id="formsend" value="Envoyer"><br/>

            </form>
            

             <?php
                //si le formulaire est bien rempli alors on poursuit
        		if(isset($_POST['formsend'])){
            		extract($_POST);

            		if(!empty($new_password) && !empty($newc_password)){

                		if($new_password == $newc_password){
                			include 'database.php'; //inclure la base de donnée @serviel.ddns.net/phpmyadmin
    						global $db;
    						$options = [
                        		'cost' => 12,
                    		];

                    		$hashpass = password_hash($new_password, PASSWORD_BCRYPT, $options); //on crypte le mot de passe avant de l'inclure dans la base de données
                			$q= $db->prepare("UPDATE users SET password = :password WHERE pseudo = '$pseudo' "); //requete SQL qui met à jour le mot de passe à l'endroit où se situe le pseudo de l'utilisateur
                        	$q->execute([
                            'password'=> $hashpass
                        	]);
                        	header('Location: deconnexion.php');
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