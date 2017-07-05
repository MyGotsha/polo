<?php
include('./connect.php');
include('./fonctions.php');

$sql = "SELECT * FROM users";
$req = mysqli_query($lien,$sql);

//Tout les mots de passe sont en clair lorsque l’on récupère la base. On fait la migration des utilisateurs et on met en production le correctif pour encrypter automatiquement le mot de passe des utilisateurs. 
$users = $req->fetch_all();

foreach ($users as $user) {
    $login = $user[0];
    $mdp = $user[1];
    $encrypt = hashPassword($mdp);
    $sql = "UPDATE users SET mdp = \"$encrypt\" WHERE login = \"$login\"";
    $lien->query($sql);
    //En rouge l’ancien mot de passe des utilisateurs et en vert le nouveau mot de passe hashé
    echo("avant hashage : <span style='color:red;'>" . $mdp . "</span>    -    et apres hashage <span style='color:green;'>: " . $encrypt) . "</span>";
    echo "<br>";
}
