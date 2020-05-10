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
                    <!-- création des boites de dialogues pour rentrer la nouvel email-->
                    <input type="email" name="new_email" id="new_email" placeholder="Votre nouvel Email"><br/>
                    <input type="email" name="newc_email" id="newc_email" placeholder="Confirmer Votre nouvel Email"><br/>
                    <input type="submit" name="formsend" id="formsend" value="Envoyer"><br/>

            </form>
            

             <?php
                //si le formulaire est bien rempli alors on poursuit
        		if(isset($_POST['formsend'])){
            		extract($_POST); //extraction des informations entrées

            		if(!empty($new_email) && !empty($newc_email)){ //si les formulaires d'email ne sont pas vides

                		if($new_email == $newc_email){
                			include 'database.php'; //inclure la base de donnée @serviel.ddns.net/phpmyadmin
    						global $db;
    						$options = [
                        		'cost' => 12,
                            ];
                            
                            $q= $db->prepare("UPDATE users SET email = :email WHERE pseudo = '$pseudo' "); //requete SQL qui met à jour l'email à l'endroit où se situe le pseudo de l'utilisateur 
                        	$q->execute([
                            'email'=> $new_email //execution de la requete
                            ]);
                        	header('Location: deconnexion.php'); //redirection à la page de deconnexion 
                        	echo "<font style=\"font family: courrier new;\"><strong>L'email' a été changé merci de vous reconnecter</strong></font>";

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