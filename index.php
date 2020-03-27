<?php
if (isset($_POST['mdp']) AND $_POST['mdp'] == "admin" AND isset($_POST['pseudo']) AND $_POST['pseudo'] == "admin" ){ 
    header('Location:dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Homepage</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css"/>
    </head>

    <body>
        <div id="wrapper">
            
            <h1>Bienvenue dans votre cloud</h1>
            <img id="cloud"src="images/cloud.png" alt="icone cloud" title="cloud"/>
            
            <form method="POST" action="index.php">
                <p>
                    <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo"/>
                    <br/>
                    <input type="password" name="mdp" id="mdp" placeholder="Password"/>
                    <br/>
                    <input type="submit" value="VALIDER" />
                    <br/>
                    <a href="inscription.php">Sign up</a>
                    <a href="pwd_forget.php">Password forget ?</a>
                </p>
             </form>
        </div>
    </body>
</html>