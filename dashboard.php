<?php session_start(); //ouverture de la session
 
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css"/>
        <?php 
        $pseudo=$_SESSION["pseudo"];
        if ($pseudo==""){
            header('Location: index.php');
        }
        $current_dir="users/$pseudo"; ?>
    </head>
    <nav>
        <a href="index.php">Déconnexion</a>
        <button disabled >Supprimer compte</button>
    </nav>
    <body>
        <h1>Bienvenue <?php echo $pseudo; ?></h1>
        <!-- Affichage -->
        <div id="stockage">
            <h2>Ici seront stockés tous les fichiers et dossiers</h2>
            <div id="dossiers">
                <?php
                    $dossiers=explode("$current_dir/",shell_exec("ls -d $current_dir/*/"));
                    $nb_dossiers= count( $dossiers );
                    for ($i=1;$i<($nb_dossiers);$i++){ // -1 pour ne pas compter le dernier \n du ls
                        ?>
                        <p class="block_dossier">
                            <img src="images/dossier.jpg" title='<?php echo "$dossiers[$i]"?>' alt= '<?php echo "$dossiers[$i]"?>' class="dirIcone"/>
                            <br/>
                            <?php echo "$dossiers[$i]"?>
                        </p>
                    <?php }
                ?>
            </div>
            <div id="fichiers">
                <?php
                    $fichiers=explode("\n",shell_exec("ls -F $current_dir| grep -v '/$'"));
                    $nb_fichiers= count( $fichiers );
                    for ($i=0;$i<($nb_fichiers-1);$i++){ // -1 pour ne pas compter le dernier \n du ls
                        ?>
                        
                            <button class='actionFileButton' type='button'><img src="images/fichier.png" title='<?php echo "$fichiers[$i]"?>' alt= '<?php echo "$fichiers[$i]"?>' class="fileIcone"/>
                            <br/>
                            <?php echo "$fichiers[$i]"?></button>
                        
                    <?php }
                ?>
            </div>
        </div>
        <p>
            <button id="fileButton">Ajouter un fichier</button>
            <output aria-live="polite"><?php if ($_SESSION['fileUpload']){echo "Fichiers uploadés";
                                                $_SESSION['fileUpload']=False;}?></output>
            <button id="updateDetails">Ajouter un dossier</button>
            <output aria-live="polite"></output>
        </p>

        <!-- Boite de dialogue création dossier -->
        <dialog id="dirDialog">
            <form method="dialog">
                <input type='text' name='nom_fichier' id="select"/>
                <menu>
                <button value="cancel">Annuler</button>
                <button id="confirmBtn" value="default">Confirmer</button>
                </menu>
            </form>
        </dialog>

        <!-- Boite de dialogue upload file -->
        
        <dialog id="fileDialog">
            <form enctype="multipart/form-data" method="post" id="form_file">
                <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
                <input type="file" name="files[]" multiple id="fileschosen"/>
                <input type="submit" value="Envoyer le(s) fichier(s)" />
                <button value="cancel" id="cancelButton">Annuler</button>
            </form>
        </dialog>
        <dialog id="actionFileDialog">
                <button type="button" id="dowloadFile">Download File</button>
                <button type="button" id="renameFile">Rename File</button>
                <button type="button" id="suppFile">Delete File</button>
                <button value="cancel" id="cancelButton">Annuler</button>
        </dialog>
        <dialog id="actionDirDialog">
                <button type="button" id="renameFile">Rename Directory</button>
                <button type="button" id="suppFile">Delete Directory</button>
                <button value="cancel" id="cancelButton">Annuler</button>
        </dialog>
        <script type="text/javascript" src="main.js"></script>
    </body>
</html>