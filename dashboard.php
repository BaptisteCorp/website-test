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
        <a href="parametres.php">Paramètres</a>
        <a href="deconnexion.php">Déconnexion</a>
    </nav>
    <body>
        <!-- Affichage  fichiers et dossiers -->
        <div id="stockage">
            <h1>Bienvenue <?php echo $pseudo; ?></h1>
            
            <div id="dossiers">
                <h2>Ici sont stockés les dossiers</h2>
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
            <h2>Ici sont stockés les fichiers </h2>
                <?php
                    $fichiers=explode("\n",shell_exec("ls -F $current_dir| grep -v '/$'"));
                    $nb_fichiers= count( $fichiers );
                    for ($i=0;$i<($nb_fichiers-1);$i++){ // -1 pour ne pas compter le dernier \n du ls
                        if (strlen($fichiers[$i])>13){
                            $affiche=substr($fichiers[$i],0,10).'...';
                        }
                        else{
                            $affiche=$fichiers[$i];
                        }
                ?>
                        
                        <button class='actionFileButton' type='button'><img src="images/fichier.png" title='<?php echo "$affiche"?>' alt= '<?php echo "$affiche"?>' class="fileIcone"/>
                        <br/>
                        <?php echo "$affiche"?></button>
                        
                    <?php }?>
            </div>
        </div>
        <!-- Boutons d'ajout -->
        <p id="paraButton">
            <div id="fileButton">
                <input type="file" name="files[]" multiple id="fileschosen"/>
                <button id="envoiFile">Envoyer</button>
            </div>
            <output aria-live="polite"><?php if ($_SESSION['fileUpload']){echo "Fichiers uploadés";
                                                $_SESSION['fileUpload']=False;}?></output>
            <button id="dirButton">Creer un dossier</button>
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

        <!-- Boite de dialogue actions files -->
        <dialog id="actionFileDialog">
                <a href="<?php echo $current_dir ?>/" Download id="fileDownloader">Download File</a>
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
        <script type= "text/javascript">
            var nb_files = <?php echo json_encode($fichiers); ?>;
            var actionFileDialog= document.getElementById('actionFileDialog');
            var cancelFileButton= document.getElementById('cancelFileButton');
            const dirUser = document.getElementById('fileDownloader').href;

            for (var i in nb_files){
                if (i==nb_files.length-1){
                    break
                }
                var fileIcon = document.getElementsByClassName('actionFileButton')[i];

                (function (arg1){
                    fileIcon.addEventListener('click', function onOpen() {
                        if (typeof actionFileDialog.showModal === "function") {
                            actionFileDialog.showModal();
                            document.getElementById('fileDownloader').href+=arg1;
                            
                        } else {
                            window.alert("L'API dialog n'est pas prise en charge par votre navigateur");
                        }
                    });
                })(nb_files[i]);

                (function (arg1){
                    cancelFileButton.addEventListener('click', function() {
                        document.getElementById('fileDownloader').href=dirUser;
                        actionFileDialog.close('Annulé');   
                    });
                })(nb_files[i]);
            }
        </script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>