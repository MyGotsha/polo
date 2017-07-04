<?php
session_start();
include('./connect.php');
include('./fonctions.php');
?><html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>Activation d'un compte</title>
		<style>@import url(styles.css);</style>
		<script language="javascript" src="fonctions.js"></script>
	</head>
	<body>
		<?php
			if(isset($_GET['login']) and isset($_GET['code'])) {
				$sql = "SELECT code FROM users WHERE login='".$_GET['login']."'";
				$req = mysqli_query($lien,$sql);
				$code = mysqli_fetch_assoc($req);
				$cd = $code['code'];
				if($cd == $_GET['code']) {
					$sql = "UPDATE users SET code='', actif='O' where login='".$_GET['login']."'";
					if($req = mysqli_query($lien,$sql)) {
						message('Activation réussie',false,'Page d\'accueil|index.php',true);
					}
				}
			}
		?>
	</body>
</html>
