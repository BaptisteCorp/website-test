<?php session_start(); //ouverture de la session

?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <nav>
        <a href="index.php">Acceuil</a>
    </nav>
    <body>
        <h1>Bienvenue <?php echo $_SESSION["mail"]; ?></h1>
        
        <div id="stockage">
            <h2>Ici seront stockés tous les fichiers et dossiers</h2>
            <div id="dossiers">
                <?php
                    $dossiers=explode("/\n",shell_exec("ls -d */"));
                    $nb_dossiers= count( $dossiers );
                    for ($i=0;$i<($nb_dossiers-1);$i++){ // -1 pour ne pas compter le dernier \n du ls
                        ?>
                        <p class="block_dossier">
                            <img src="images/dossier.jpg" title='<?php echo "$dossiers[$i]"?>' alt= '<?php echo "$dossiers[$i]"?>' class="icone"/>
                            <br/>
                            <?php echo "$dossiers[$i]"?>
                        </p>
                    <?php }
                ?>
            </div>
            <div id="fichiers">
                <?php
                    $fichiers=explode("\n",shell_exec("ls -F | grep -v '/$'"));
                    $nb_fichiers= count( $fichiers );
                    for ($i=0;$i<($nb_fichiers-1);$i++){ // -1 pour ne pas compter le dernier \n du ls
                        ?>
                        <p class="block_dossier">
                            <img src="images/fichier.png" title='<?php echo "$fichiers[$i]"?>' alt= '<?php echo "$fichiers[$i]"?>' class="icone"/>
                            <br/>
                            <?php echo "$fichiers[$i]"?>
                        </p>
                    <?php }
                ?>
            </div>
        </div>
        <p>
            <a href="ajout_fichier.php">Ajouter un fichier</a>
            <button id="updateDetails">Ajouter un dossier</button>
            <output aria-live="polite"></output>
        </p>
        <dialog id="favDialog">
            <form method="dialog">
                <input type='text' name='nom_fichier' id="select"/>
                <menu>
                <button value="cancel">Annuler</button>
                <button id="confirmBtn" value="default">Confirmer</button>
                </menu>
            </form>
        </dialog>
        <script type="text/javascript" src="main.js"></script>
    </body>
</html>