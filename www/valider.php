<?php
session_start();
include('./connect.php');
include('./fonctions.php');
if(!isset($_SESSION['sess_log'])) header('Location: index.php');
UpdConnected();
?>
<html>
<head>
<title>Validation d'informations</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>@import url(styles.css);</style>
<script language="javascript" src="fonctions.js"></script>
</head>

<body>
<?php

if(isset($_POST['type'])) $type = $_POST['type'];
if(isset($_GET['type'])) $type = $_GET['type'];

if(isset($type)) {
	switch($type) {
		case 'inscription' :
			mysqli_autocommit($lien,true);
			//Contrôle de l'ensemble des champs
			if($_POST['nom'] != '' && $_POST['login'] != '' && $_POST['mdp'] != '' && $_POST['email'] != '') {
				//Vérification de la concordence entre le mot de passe et sa confirmation
				if($_POST['mdp'] == $_POST['mdp2']) {
					if($_POST['code'] == $_SESSION['code']) {	//Vérification du code de sécurité
						//vérification que le login n'existe pas déjà
						$sql = "SELECT * FROM users WHERE LOGIN='".$_POST['login']."'";
						$req = mysqli_query($lien,$sql);
						if(mysqli_num_rows($req) == 0) {
						  $sql = "INSERT INTO users SET login='".$_POST['login']."', mdp='".$_POST['mdp']."', nom='".$_POST['nom']."', prenom='".$_POST['prenom']."', email='".$_POST['email']."'";
							if($req = mysqli_query($lien,$sql)) {
								//On génère le mail
								$tab['to'] = $_POST['email'];
								$tab['login'] = $_POST['login'];
     							genereMail('activation',$tab);
								message('Inscription r&eacute;ussie.',false,'Page d\'accueil|index.php');
							} else {
								message('Il s\'est produit une erreur dans l\'inscription.',true,'Retour|inscription.php');
							}
						} else {
							message('Login existant!!!',true,'Retour|inscription.php');
						}
					} else {
						message('Le code de s&eacute;curit&eacute; que vous avez entr&eacute; ne correspond pas!!',true,'Retour|inscription.php');
					}
				} else {
					message('Le mot de passe et sa confirmation ne correspondent pas!!',true,'Retour|inscription.php');
				}
			} else {
				message('Il manque une information!!',true,'Retour|inscription.php');
			}
		break;

		case 'add_post' :
			if($_POST['text'] != '') {
				mysqli_autocommit($lien,false);
				$text = formatText($_POST['text']);
				$sql = "INSERT INTO posts SET id_topic='".$_POST['id_topic']."', text='".$text."', login='".$_SESSION['sess_log']."'";
				
				if($req = mysqli_query($lien,$sql)) {
					mysqli_commit($lien);
					message('Votre post vient d\'&ecirc;tre publi&eacute;.',false,'Retour au topic|posts.php?id_topic='.$_POST['id_topic']);
				} else {
					mysqli_rollback($lien);
					message('Il y a eu une erreur dans l\'ajout de votre post!!!',true,'Retour au topic|posts.php?id_topic='.$_POST['id_topic']);
				}
			} else {
				message('Vous n\'avez pas tap&eacute; de texte!!!',false,'Retour au topic|posts.php?id_topic='.$_POST['id_topic']);
			}
		break;

		case 'add_topic' :
			if($_POST['text'] != '' && $_POST['titre'] != '') {
				mysqli_autocommit($lien,false);

        $titre = formatText($_POST['titre']);
				$text = formatText($_POST['text']);

				//Création du topic avec récupération de l'id
				$sql = "INSERT INTO topics SET id_forum='".$_POST['id_forum']."', titre='".$titre."', login='".$_SESSION['sess_log']."'";
				if(!$req = mysqli_query($lien,$sql)) {mysqli_rollback($lien);die("Erreur SQL : ".mysqli_error($lien));}
				$id_topic = mysqli_insert_id($lien);

				//Insertion du premier post
				$sql = "INSERT INTO posts SET id_topic='".$id_topic."', text='".$text."', login='".$_SESSION['sess_log']."'";
				if($req = mysqli_query($lien,$sql)) {
				  mysqli_commit($lien);
					message('Votre post vient d\'&ecirc;tre publi&eacute;.',false,'Retour au topic|posts.php?id_topic='.$id_topic);
				} else {
				  mysqli_rollback($lien);
					message('Il y a eu une erreur dans l\'ajout de votre post!!!<br />Erreur Mysql : '.mysqli_error($lien),false,'Retour au topic|posts.php?id_topic='.$id_topic);
				}
			}
		break;

		case 'suppTopic':
			if(isset($_GET['id_topic']) and $_SESSION['sess_admin'] == 'O') {
				mysqli_autocommit($lien,false);

				$sql = 'SELECT id_forum FROM topics WHERE id_topic='.$_GET['id_topic'];
				$req = mysqli_query($lien,$sql);
				$tmp = mysqli_fetch_assoc($req);
				$id_forum = $tmp['id_forum'];

				//Suppression des posts liés
				$sql = "DELETE FROM posts WHERE id_topic=".$_GET['id_topic'];
				if($req = mysqli_query($lien,$sql)) {
					//Suppression du topic
					$sql = "DELETE FROM topics WHERE id_topic=".$_GET['id_topic'];
					if(!$req = mysqli_query($lien,$sql)) {
						mysqli_rollback($lien);
						die('Erreur SQL : '.mysqli_error($lien));
					} else {
						mysqli_commit($lien);
						message('Votre topic vient d\'&ecirc;tre supprim&eacute;.',false,'Retour au forum|topics.php?id_forum='.$id_forum);
					}
				}
			}
		break;

		case 'suppPost':
			if(isset($_GET['id_post'])) {
				mysqli_autocommit($lien,false);

				$sql = 'SELECT posts.id_topic,topics.id_forum,posts.login '.
					'FROM posts,topics '.
					'WHERE posts.id_topic = topics.id_topic '.
					'AND id_post='.$_GET['id_post'];
				$req = mysqli_query($lien,$sql);
				$tmp = mysqli_fetch_assoc($req);
				$id_topic = $tmp['id_topic'];
				$id_forum = $tmp['id_forum'];

				if($tmp['login'] != $_SESSION['sess_log'] and $_SESSION['sess_admin'] != 'O') message('Vous n\'avez pas le droit de supprimer ce post!!',true);

				$sql = 'DELETE FROM posts WHERE id_post='.$_GET['id_post'];
				if(!$req = mysqli_query($lien,$sql)) {mysqli_rollback($lien);die('Erreur SQL : '.mysqli_error($lien));}

				$sql = 'SELECT * FROM posts WHERE id_topic='.$id_topic;
				$req = mysqli_query($lien,$sql);
				$nb = mysqli_num_rows($req);
				if($nb == 0) {
					$sql = 'DELETE FROM topics WHERE id_topic='.$id_topic;
					if(!$req = mysqli_query($lien,$sql)) {mysqli_rollback($lien);die('Erreur SQL : '.mysqli_error($lien));}
				}
				if($nb!=0) {
					message('Votre post vient d\'&ecirc;tre supprim&eacute;.',false,'Retour au topic|posts.php?id_topic='.$id_topic);
				} else {
					message('Votre post vient d\'&ecirc;tre supprim&eacute;.',false,'Retour au forum|topics.php?id_forum='.$id_forum);
				}
				mysqli_commit($lien);
			}
		break;

		case 'modPost':
			if(isset($_POST['id_post'])) {
				mysqli_autocommit($lien,false);

				$sql = 'SELECT posts.id_topic '.
				'FROM posts '.
				'WHERE id_post='.$_POST['id_post'];
				$req = mysqli_query($lien,$sql);
				$tmp = mysqli_fetch_assoc($req);
				$id_topic = $tmp['id_topic'];

				$sql="UPDATE posts SET date=date, text='".$_POST['text']."' WHERE id_post=".$_POST['id_post'];

				if(!$req = mysqli_query($lien,$sql)) {mysqli_rollback($lien);die('Erreur SQL : '.mysqli_error($lien));}
				mysqli_commit($lien);
				message('Votre post vient d\'&ecirc;tre modifi&eacute;.',false,'Retour au topic|posts.php?id_topic='.$id_topic);
			}
		break;
	}
}
?>
</body>
</html>
