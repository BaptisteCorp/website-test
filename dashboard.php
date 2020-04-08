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
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/dashboard.css"/>
    </head>

    <!-- Actions de navigation -->
    <nav>
        <div id="monicone">
            <img src=/images/cloud.png title='icone' id='icone'>
        </div>
        <div id='nav'>
            
            <input type='text' placeholder='Rechercher'>
            <h1>Bonjour <?php echo $pseudo; ?></h1>
            <div id='icoParam'>
                <a href="parametres.php" class='param'><img src="images/parametre.png" class='ico'/></a>
                <a href="deconnexion.php"class='param'><img src="images/logout.png" class='ico'/></a>
            </div>
        </div>
    </nav>
    <body>
        
        <div class="sidenav">
            <button disabled><img src="images/plus.png" id='plus'/> Nouveau</button>
            <button disabled>Mon Cloud</button>
            <button disabled>Partagé</button>
            <button disabled>Important</button>
        </div>
        <!-- Affichage  fichiers et dossiers -->
        <div id="stockage">
            
            
            <div id="dossiers">
                <h2>Dossiers</h2>
                <?php
                    $dossiers=explode("$current_dir/",shell_exec("ls -d $current_dir/*/"));
                    $nb_dossiers= count( $dossiers );
                    for ($i=1;$i<($nb_dossiers);$i++){ // depart de 1 pour ne pas compter le premier vide
                ?>
                        <button class='actionDirButton' type='button'><img src="images/dossier.jpg" title='<?php echo "$dossiers[$i]"?>' alt= '<?php echo "$dossiers[$i]"?>' class="dirIcone"/>
                        <br/>
                        <?php echo "$dossiers[$i]"?></button>
                        
                    <?php }?>
                <button id="dirButton">Créer un dossier</button>
                <output aria-live="polite"></output>
            </div>
            <div id="fichiers">
                <h2>Fichiers</h2>
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
                
                    <input type="file" name="files[]" multiple id="fileschosen"/>
                    <button id="envoiFile">Envoyer</button>
                
                <output aria-live="polite"><?php if ($_SESSION['fileUpload']){echo "Fichiers importés";
                                                $_SESSION['fileUpload']=False;}?></output>
            </div>
        </div>

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
                <h1 id="nom_file"></h1>
                <a href="<?php echo $current_dir ?>/" Download id="fileDownloader">Télécharger</a>
                <button type="button" id="renameFile">Renommer</button>
                <button type="button" id="suppFile" >Supprimer</button>
                <button value="cancel" id="cancelFileButton">Annuler</button>
        </dialog>

        <!-- Boite de dialogue actions dossiers -->
        <dialog id="actionDirDialog">
                <h1 id="nom_dir"></h1>
                <button type="button" id="renameDir">Renomer</button>
                <button type="button" id="suppDir" >Supprimer</button>
                <button value="cancel" id="cancelDirButton">Annuler</button>
        </dialog>

        <script type= "text/javascript">
            var nb_files = <?php echo json_encode($fichiers); ?>;
            var actionFileDialog= document.getElementById('actionFileDialog');
            var cancelFileButton= document.getElementById('cancelFileButton');
            const dirUser = document.getElementById('fileDownloader').href;
            var suppFile = document.getElementById('suppFile');
            var fileSelected = '';


            for (var i in nb_files){
                if (i==nb_files.length-1){
                    break
                }
                var fileIcon = document.getElementsByClassName('actionFileButton')[i];

                (function (arg1){
                    fileIcon.addEventListener('click', function onOpen() {
                        document.getElementById('nom_file').innerHTML=arg1
                        if (typeof actionFileDialog.showModal === "function") {
                            actionFileDialog.showModal();
                            document.getElementById('fileDownloader').href+=arg1;
                            fileSelected+=arg1;
                            
                            
                        } else {
                            window.alert("L'API dialog n'est pas prise en charge par votre navigateur");
                        }
                    });
                
                    cancelFileButton.addEventListener('click', function() {
                        document.getElementById('fileDownloader').href=dirUser;
                        actionFileDialog.close('Annulé');
                        fileSelected='';   
                    });

                    suppFile.addEventListener('click',function(){
                        if (fileSelected!=''){
                        const xhttp = new XMLHttpRequest();
                        const destination='suppFile.php?suppFile='+fileSelected;
    
                        xhttp.open("GET",destination);
                        xhttp.send();
                        fileSelected='';}
                        document.location.href="dashboard.php"; 
                    });
                })(nb_files[i]);
            }
        </script>
        <script type= "text/javascript">
            var nb_dossiers = <?php echo json_encode($dossiers); ?>;
            var actionDirDialog= document.getElementById('actionDirDialog');
            var cancelDirButton = document.getElementById('cancelDirButton');
            //const dirUser = document.getElementById('fileDownloader').href;
            var suppDir = document.getElementById('suppDir');
            var dirSelected = '';


            for (var i in nb_dossiers){
                if (i==0){
                    continue
                }
                var dirIcon = document.getElementsByClassName('actionDirButton')[i-1];

                (function (arg1){
                    dirIcon.addEventListener('click', function onOpen() {
                        document.getElementById('nom_dir').innerHTML=arg1
                        if (typeof actionDirDialog.showModal === "function") {
                            actionDirDialog.showModal();
                            dirSelected+=arg1;
                        } else {
                            window.alert("L'API dialog n'est pas prise en charge par votre navigateur");
                        }
                    });

                    cancelDirButton.addEventListener('click', function() {
                        actionDirDialog.close('Annulé'); 
                        dirSelected='';  
                    });

                    dirIcon.addEventListener('dblclick',function(){
                        
                        const xhttp = new XMLHttpRequest();
                        const destination='changement_dir.php?nom_dossier='+arg1;
    
                        xhttp.open("GET",destination);
                        xhttp.send();
                       
                    });

                    suppDir.addEventListener('click',function(){
                        if (dirSelected!=''){
                        const xhttp = new XMLHttpRequest();
                        const destination='suppDir.php?suppDir='+dirSelected;
    
                        xhttp.open("GET",destination);
                        xhttp.send();
                        dirSelected='';}
                        document.location.href="dashboard.php"; 
                    });
                })(nb_dossiers[i]);
            }
        </script>
        <script type="text/javascript" src="js/dashboard.js"></script>
    </body>
</html>