<?php session_start(); //ouverture de la session
    //Récuperation du pseudo
    $pseudo=$_SESSION["pseudo"];
    if ($pseudo==""){
        header('Location: index.php');
    }
    //Récuperation du dossier usilisateur correspondant au pseudo
    $current_dir="users/$pseudo";
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/dashboard.css"/>
    </head>

    <!-- Actions de navigation -->
    <nav>
        <a href="deconnexion.php">Déconnexion</a>
        <a href="parametres.php">Paramètres</a>
        <a href='/users/Paulo/ch2.jpg' Download>test dowload</a>
    </nav>
    <body>
        <!-- Affichage  fichiers et dossiers -->
        <div id="stockage">
            <h1>Bienvenue <?php echo $pseudo; ?></h1>
            <h2>Ici sont stockés tous tes fichiers et dossiers</h2>
            <div id="dossiers">
                <?php
                    $dossiers=explode("$current_dir/",shell_exec("ls -d $current_dir/*/"));
                    $nb_dossiers= count( $dossiers );
                    for ($i=1;$i<($nb_dossiers);$i++){ // depart de 1 pour ne pas compter le premier vide
                ?>
                        <button class='actionDirButton' type='button'><img src="images/dossier.jpg" title='<?php echo "$dossiers[$i]"?>' alt= '<?php echo "$dossiers[$i]"?>' class="dirIcone"/>
                        <br/>
                        <?php echo "$dossiers[$i]"?></button>
                        
                    <?php }?>
            </div>
            <div id="fichiers">
                <?php
                    $fichiers=explode("\n",shell_exec("ls -F $current_dir| grep -v '/$'"));
                    $nb_fichiers= count( $fichiers );
                    for ($i=0;$i<($nb_fichiers-1);$i++){ // -1 pour ne pas compter le dernier \n du ls
                        if (strlen($fichiers[$i])>13){
                            $fichiers[$i]=substr($fichiers[$i],0,10).'...';
                        }
                ?>
                        
                        <button class='actionFileButton' type='button'><img src="images/fichier.png" title='<?php echo "$fichiers[$i]"?>' alt= '<?php echo "$fichiers[$i]"?>' class="fileIcone"/>
                        <br/>
                        <?php echo "$fichiers[$i]"?></button>
                        
                    <?php }?>
            </div>
        </div>
        <!-- Boutons d'ajout -->
        <p>
            <button id="fileButton">Ajouter un fichier</button>
            <output aria-live="polite"><?php if ($_SESSION['fileUpload']){echo "Fichiers uploadés";
                                                $_SESSION['fileUpload']=False;}?></output>
            <button id="dirButton">Ajouter un dossier</button>
            <output aria-live="polite"></output>
        </p>


        <!-- Boites de dialogue pour les actions -->

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

        <!-- Boite de dialogue actions files -->
        <dialog id="actionFileDialog">
                <a href="<?php echo $current_dir ?>/Capture.PNG" Download >Download File</a>
                <button type="button" id="renameFile">Rename File</button>
                <button type="button" id="suppFile">Delete File</button>
                <button value="cancel" id="cancelFileButton">Annuler</button>
        </dialog>

        <!-- Boite de dialogue actions dossiers -->
        <dialog id="actionDirDialog">
                <button type="button" id="renameFile">Rename Directory</button>
                <button type="button" id="suppFile">Delete Directory</button>
                <button value="cancel" id="cancelDirButton">Annuler</button>
        </dialog>

        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>