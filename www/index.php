<?php
session_start();
include('./connect.php');
include('./fonctions.php');

if(isset($_GET['deco'])) {
	$_SESSION['sess_log'] = '';
	$_SESSION['sess_nom'] = '';
	$_SESSION['sess_admin'] = '';
}

$_SESSION['retourRech'] = $_SERVER['REQUEST_URI'];

//Authentification
if(isset($_POST['valider'])) {
	//modification de la variable pour aller chercher le mot de passe hashé avec la fonction "hashPassword" en sha256 dans fonctions.php
	$sql = "SELECT login,nom,prenom,admin FROM users WHERE login='".$_POST['login']."' AND mdp='".hashPassword($_POST['mdp'])."' AND actif='O'";
	$req = mysqli_query($lien,$sql);

	if(mysqli_num_rows($req) == 1) {
		$tmp = mysqli_fetch_assoc($req);
		$_SESSION['sess_log'] 	= $tmp['login'];
		$_SESSION['sess_nom'] 	= $tmp['prenom'].' '.$tmp['nom'];
		$_SESSION['sess_admin'] = $tmp['admin'];
	}	else {
		$_SESSION['sess_log'] 	= '';
		$_SESSION['sess_nom'] 	= '';
		$_SESSION['sess_admin'] = '';
	}
}

UpdConnected();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Forum</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>@import url(styles.css);</style>
<script>
  function checkLog() {
    login = document.form1.login.value;
    mdp = document.form1.mdp.value;
    if(login == '' || mdp == '') {
      return false;
    } else {
      return true;
    }
  }
</script>
<script language="javascript" src="fonctions.js"></script>
</head>

<body>
<h1>Liste des FORUMS</h1>
<br>
<br>
<span class="welcome">
<?php
if($_SESSION['sess_log'] == '') {
	echo 'Utilisateur anonyme';
} else {
	echo 'Bienvenue '.$_SESSION['sess_nom'];
}
?><br></span>
<br>
<table align="center" width="95%">
<?php
echo '<tr><td align="right">'.recherche('tout').'</td></tr>';
$sql = 'select * from forums';
$req = mysqli_query($lien,$sql);
while($ligne = mysqli_fetch_object($req)) {
	echo '<tr><td><a href="topics.php?id_forum='.$ligne->id_forum.'">'.strtoupper($ligne->titre).'</a><br>';
	echo ''.$ligne->description.'</i></font>';
	echo '</td></tr>';
	echo '<tr height="30"><td>&nbsp;</td></tr>';
}
?>
</table>
<br>
<br>
<?php
if($_SESSION['sess_log'] != '') {
	echo '<center><a href="index.php?deco=1">Se d&eacute;connecter</a></center>';
} else {
	?>
	<form name="form1" method="POST" action="">
		<table align="center" class="auth">
			<tr align="center"><td colspan="2"><b>Identifiez-vous :</b></td></tr>
			<tr>
				<td class="lib">Login :</td>
				<td><input type="text" name="login" maxlength="15" size="15"></td>
			</tr>
			<tr>
				<td class="lib">Mot de passe :</td>
				<td><input type="password" name="mdp" maxlength="10" size="10"></td>
			</tr>
			<tr align="right">
				<td colspan="2"><input type="submit" name="valider" value="Valider" onClick="return checkLog()"></td>
			</tr>
		</table>
	</form>
<center><a href="inscription.php">S'inscrire</a></center>
<?php
}

echo "<span class=\"liste\">Liste des utilisateurs connect&eacute;s : ".afficheConnected()."</span>";

?>
</body>
</html>
