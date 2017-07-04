<?php
session_start();
include('./connect.php');
include('./fonctions.php');
if(!isset($_GET['id_topic'])) header('Location: index.php');
UpdConnected();
?>
<html>
<head>
<title>Liste des posts du topic : <?php
$req_top = mysqli_query($lien,"select id_forum,titre from topics where id_topic='".$_GET['id_topic']."'");
$res = mysqli_fetch_assoc($req_top);
$titre_topic = $res['titre'];
$id_forum = $res['id_forum'];
echo $titre_topic;
//MAJ du compteur vu pour le topic
$sql = "UPDATE topics SET nbvu = (nbvu + 1),date=date WHERE id_topic=".$_GET['id_topic'];
$res = mysqli_query($lien,$sql);

//MAJ de la table des visites
if($_SESSION['sess_log'] != '') {
	mysqli_autocommit($lien,true);
	$sql = "SELECT * FROM visites WHERE id_topic=".$_GET['id_topic']." AND login='".$_SESSION['sess_log']."'";
	$req = mysqli_query($lien,$sql);
	if(mysqli_num_rows($req) == 0) {
		$sql = "INSERT INTO visites (id_topic,login) VALUES (".$_GET['id_topic'].",'".$_SESSION['sess_log']."')";
	} else {
		$sql = "UPDATE visites SET date=CURRENT_TIMESTAMP WHERE id_topic=".$_GET['id_topic']." AND login='".$_SESSION['sess_log']."'";
	}
	if(!$req = mysqli_query($lien,$sql)) {message('Erreur SQL : '.mysqli_error($lien));}
}


?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>@import url(styles.css);</style>
<script language="javascript" src="fonctions.js"></script>
</head>

<body>
<?php
echo '<h1>'.mef($titre_topic).'</h1>';

echo '<table class="tableau" align="center" cellpadding="0" cellspacing="0">';

$sql = "SELECT * FROM posts WHERE id_topic='".$_GET['id_topic']."' ORDER BY date ASC";
$req = mysqli_query($lien,$sql);
while($ligne = mysqli_fetch_object($req)) {
	$time = formatDate($ligne->date);
	echo '<tr><td class="entetePost">';
	echo '<table width="100%"><tr><td align="left">';
	echo 'Post&eacute; par '.$ligne->login.' le '.$time.'</td>';
	echo '<td align="right">';
	if ($_SESSION['sess_admin'] == 'O' or $_SESSION['sess_log'] == $ligne->login) {
		echo '<a href="posts.php?id_topic='.$_GET['id_topic'].'&type=modPost&id_post='.$ligne->id_post.'">Mod.</a> - ';
		echo '<a href="valider.php?type=suppPost&id_post='.$ligne->id_post.'">Supp.</a>';
	}

	echo '</td></tr></table>';
	echo '</td></tr>';
	echo '<tr><td class="post">'.mef($ligne->text).'</td></tr>';
}
echo '</table>';
?>
<br>
<?php
if($_SESSION['sess_log'] != '') {

	$valText = '';
	$type = 'add_post';
	$id_post = '';

	if(isset($_GET['type']) and isset($_GET['id_post'])) {
		$sql = "SELECT text,login FROM posts WHERE id_post=".$_GET['id_post'];
		if($req = mysqli_query($lien,$sql)) {
			$post = mysqli_fetch_assoc($req);
			$valText = $post['text'];
			$type = 'modPost';
			$id_post = $_GET['id_post'];
		}
	}

	echo '<form name="form1" method="post" action="valider.php">';
	echo '<center><b>Poster une réponse :</b> - <a href="javascript:smileys()">Liste des smileys</a></center>';
	echo '<center><textarea name="text" cols="64" rows="10">'.$valText.'</textarea></center>';
	echo '<center><input type="submit" name="Valider" value="Valider"></center>';
	echo '<input type="hidden" name="id_topic" value="'.$_GET['id_topic'].'">';
	echo '<input type="hidden" name="id_post" value="'.$_GET['id_post'].'">';
	echo '<input type="hidden" name="type" value="'.$type.'">';
	echo '</form>';
}
?>
<br>
<center><a href="topics.php?id_forum=<?php echo $id_forum; ?>">Liste des topics</a></center>
</body>
</html>
