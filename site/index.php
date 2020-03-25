<?php
if (isset($_POST['mdp']) AND $_POST['mdp'] == "Paul*"){ 
    header('Location:dashboard.php');
}

$title = "Connexion";
require 'header.php'; 
?>

    <div id="wrapper">

            <section id="main">
                <header>
                    <h1>Connexion</h1>
                </header>
                
                <footer>
                    <ul class="icons">
                        <div class="cadre">
                            <h5>Entrer le mot de passe</h5>
                            <div class="form-row" id="wrapper" >
                                <div class="col-6" id="wrapper" >
                                    <form action="index.php" method="post">                                    
                                        <input type="password" name="mdp" />
                                        <br>
                                        <input type="submit" value="Valider" />
                                        </p>
                                    </form>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['mdp']) AND !empty($_POST['mdp']) AND $_POST['mdp'] != "Paul*") {
                                echo "Erreur de mot de passe";
                            }
                            ?>
                        </div>
                    </ul>
                </footer>
            </section>

        <!-- Footer -->
            <footer id="footer">
                <ul class="copyright">
                <li>&copy; CHABOT FAMILY - 2020</li>
                </ul>
            </footer>
    </div>

<?php 
require 'footer.php'; 
?>