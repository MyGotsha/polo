<?php
include('./connect.php');
include('./fonctions.php');

$sql = "SELECT * FROM users";
$req = mysqli_query($lien,$sql);

$users = $req->fetch_all();

foreach ($users as $user) {
    $login = $user[0];
    $mdp = $user[1];
    $encrypt = hashPassword($mdp);
    $sql = "UPDATE users SET mdp = \"$encrypt\" WHERE login = \"$login\"";
    $lien->query($sql);
    echo("avant hashage : <span style='color:red;'>" . $mdp . "</span>    -    et apres hashage <span style='color:green;'>: " . $encrypt) . "</span>";
    echo "<br>";
}
