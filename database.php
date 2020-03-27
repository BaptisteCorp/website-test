<?php
	define('HOST','localhost');
	define('DB_NAME','siteweb'); //nom de la BDD
	define('USER','root'); //utilisateur qui se connecte
	define('PASS',''); //pas de mdp de base

	try{
		$db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS); #définition du chemin de la BDD
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); #deux types d'erreur
	} catch (PDOException $e){
		echo $e; #affichage de l'erreur de connexion

	}
