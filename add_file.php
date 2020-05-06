<?php 
// Check if image file is a actual image or fake image
if(isset($_POST["submit"]) && isset($_FILES['fileToUpload'])) {

    session_start(); //ouverture de la session
    $target_dir = $_SESSION['currentDir'];
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $pseudo=$_SESSION['pseudo'];

    include 'database.php';
    global $db;
    $donnees=$db->prepare("SELECT data FROM users WHERE pseudo = '$pseudo'");
    $donnees->execute();
    $nbgo = $donnees->fetch();
    $dataUsed=explode('users',shell_exec("du -s users/$pseudo"))[0];
    $dataUsed=(int)$dataUsed;
    $dataUsed*=10**-6;

    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Un fichier du même nom existe déjà";
        $uploadOk = 0;
    }
    // Check file size 7Mb
    if ($_FILES["fileToUpload"]["size"]*10**-9+$dataUsed > $nbgo[0]) {
        echo "Pas assez d'espace de stockage\nVous pouvez demander plus d'espace dans Paramètres>Infos Stockages>Plus de Go";
        $uploadOk = 0;
    }

    /*
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "pdf" ) {
        echo "Sorry, only JPG, JPEG, PNG, PDF & GIF files are allowed.";
        $uploadOk = 0;
    }
    */

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The fichier ". basename( $_FILES["fileToUpload"]["name"]). " a été ajouté";
        } else {
            echo "Une erreur est survenue";
        }
    }
}
?>
<html>
	</br>
	<a href="dashboard.php">Retour</a>
</html>