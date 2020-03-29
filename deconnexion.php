<?php session_start(); //ouverture de la session



session_unset();
session_destroy();
echo "Vous êtes désormais déconnecté...";
echo "Retour vers la page d'acceuil";
header('Location: index.php');
?> 