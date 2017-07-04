<?php
//Paramètres de connexion au serveur MySQL
//Nom de l'utilisateur
$user = 'root';
//Mot de passe
$password = 'root';
//Adresse IP ou nom DNS du serveur MySQL
$host = 'mysqldev';
//Base de données du forum
$db = 'forum';

$lien = mysqli_connect($host,$user,$password,$db);
mysqli_set_charset($lien,"utf8");

?>
