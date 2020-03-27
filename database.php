<?php
define('HOST','http://serviel.ddns.net/phpmyadmin/'); //j'ai caché le nom
define('DB_NAME','siteweb'); //nom de la BDD
define('USER','root'); //utilisateur qui se connecte
define('PASS','Ensimtruite.'); //le mot de passe que j'utilise pour me connecté à la BDD
try{
 $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 echo "Connect > OK !";
} catch (PDOException $e){
 echo $e; #affichage de l'erreur de connexion
}
?>