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
        <h1>Bienvenue admin</h1>
        <div id="stockage">
            <h2>Ici seront stockés tous les fichiers et dossiers</h2>
            <div id="dossiers">
                <img src="images/dossier.jpg" class="icone"/>
            </div>
            <div id="fichiers">
                <img src="images/fichier.png" class="icone"/>
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