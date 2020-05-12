<?php
    session_start(); //ouverture de la session
    if (isset($_GET['dossier']) && isset($_GET['fichier'])){ //déplacer un fichier dans un dossier
        $dossier=$_GET['dossier'];
        $fichier=$_GET['fichier'];
        $current_dir=$_SESSION['currentDir'];

        shell_exec( "mv $current_dir'$fichier' $current_dir$dossier");

    }else if(isset($_GET['fichier'])){// déplacer un fichier dans le dossier parent
        $fichier=$_GET['fichier'];
        //Récuperation du dossier usilisateur correspondant au pseudo
        $current_dir=$_SESSION['currentDir'];
        $pseudo=$_SESSION['pseudo'];
        if ($current_dir!="users/$pseudo/"){ // interdit de sortir un fichier de son espace personnel
            echo shell_exec( "mv $current_dir'$fichier' $current_dir/../");
        }
        
    }else if (isset($_GET['nom_dossier'])){ // permet de se réplacer dans le dossier selectionné
        $nom_dossier=$_GET['nom_dossier'];
        $_SESSION["currentDir"]=$_SESSION["currentDir"].$nom_dossier;

    }else if (isset($_GET['return'])){  // permet de se déplacer dans le dossier parent
        $chemin=explode('/',$_SESSION["currentDir"]);
        array_splice($chemin,-2);
        if (count($chemin)>1){ //interdit l'accès hors de son dossier personnel
            $chemin=implode('/',$chemin).'/';
            $_SESSION["currentDir"]=$chemin;
        }
    }
    usleep(300000);//wait 300ms
    header('Location: dashboard.php');
?>