<!--<?php session_start(); //ouverture de la session
    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];
    $email=$_SESSION["lemail"];
    $password=$_SESSION["lpassword"];

?> -->

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
                    <input type="email" name="emaile" id="emaile" placeholder="Votre Email"><br/>
                    <input type="submit" name="formsend" id="formsend" value="Envoyer"><br/>

            </form>
            

            <?php
            	include 'database.php';
    			global $db;


                if(isset($_POST['formsend'])){
                    extract($_POST);

                    $c = $db->prepare("SELECT email FROM users WHERE email = :email");
                    $c->execute(['email' => $emaile]);
                    $result = $c->rowCount();
                    if($result == 1){
	                    $length=10;
	    				$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Création d'un de mot de passe de 10 caractères aléatoires avant chiffres majuscules et minuscules
	    				$string = '';
	    				for($i=0; $i<$length; $i++){
	        				$string .= $chars[rand(0, strlen($chars)-1)];
	    				}

					        $success=mail($emaile,"Oubli de mot de passe","Voici votre mot de passe temporaire merci de le changer dès que possible: $string",'From: webmaster@serviel.com'); // envoi du mail à l'utilisateur
					        if (!$success) {
					            $errorMessage = error_get_last()['message'];
					            echo $errorMessage;
					        }
					        else{
					            echo "Mail envoyé ;)";
					            $options = [
                        			'cost' => 12,
                    			];
					            $hashpass = password_hash($string, PASSWORD_BCRYPT, $options);
                				$q= $db->prepare("UPDATE users SET password = :password WHERE email = :emaile");
                        		$q->execute([
                            		':password'=> $hashpass,
                            		':emaile'=> $emaile

                        		]);
					        }
        			}
        		}
       		?>
   		</div>
    </body>
</html>