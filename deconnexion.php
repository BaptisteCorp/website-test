<?php session_start(); //ouverture de la session



session_unset();
session_destroy(); //on vide la session puis on la détruit
echo "Vous êtes désormais déconnecté...";
echo "Retour vers la page d'acceuil";
header('Location: index.php');
?> 