<?php
session_start();
include('./connect.php');
include('./fonctions.php');
if(!isset($_GET['id_forum'])) header('Location: index.php');

$_SESSION['retourRech'] = $_SERVER['REQUEST_URI'];

UpdConnected();
?>
<html>
<head>
<title>Liste des topics du forum : <?php
$req_for = mysqli_query($lien,"select titre from forums where id_forum='".$_GET['id_forum']."'");
$res = mysqli_fetch_assoc($req_for);
$titre_forum = $res['titre'];
echo $titre_forum;
?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style>@import url(styles.css);</style>
<script language="javascript" src="fonctions.js"></script>
</head>

<body>
<?php
echo '<h1>'.strtoupper($titre_forum).'</h1>';

echo '<table class="tableau" align="center" style="border: 0px;"><tr><td align="right">'.recherche('topic',$_GET['id_forum']).'</td></tr></table>';
echo '<table class="tableau" align="center" cellpadding="0" cellspacing="0" border=1>';
echo '<tr class="entete">';
echo '<th>Topics</th>';
echo '<th>Nb posts</th>';
echo '<th>Nb vu</th>';
echo '<th>&nbsp;</th>';
echo '<th>Auteur</th>';
echo '<th>Dernier<br />post</th>';
if ($_SESSION['sess_admin'] == 'O') echo '<th>Supp.</th>';
echo '</tr>';

$altern = false;


$sql  = 'select *,
				(select count(*) from posts p where p.id_topic = t.id_topic) as nbpost,
				(select max(date) from posts p where p.id_topic = t.id_topic) as lastpost,
				(select login from posts p where p.id_topic = t.id_topic order by p.date desc limit 0,1) as lastlogin,
				(select v.date from visites v where v.login = \''.$_SESSION['sess_log'].'\' and v.id_topic = t.id_topic) as lastvisite
				from topics t
				where id_forum = '.$_GET['id_forum'].'
				order by lastpost desc';

$req_topics = mysqli_query($lien,$sql);
while($ligne = mysqli_fetch_object($req_topics)) {

	//Topic changé depuis dernière visite ?
	$flag = '';
	if($ligne->lastvisite != '') {
		$diff = strcmp($ligne->lastvisite,$ligne->lastpost);
		if($diff >= 0) $flag = '<img src="images/flagbleu.gif" title="Topic visit&eacute;">';
		if($diff < 0) $flag = '<img src="images/flagred.gif" title="Nouveaux posts dans ce topic">';
	}

	$time = formatDate($ligne->date);
	$lasttime = formatDate($ligne->lastpost);

	$nb_post = $ligne->nbpost;
	$nb_vu = $ligne->nbvu;

	$class = ($altern) ? ' class="A"' : ' class="B"';

	echo '<tr'.$class.'>';
	echo '<td class="libelle"><a href="posts.php?id_topic='.$ligne->id_topic.'">'.mef($ligne->titre).'</a></td>';
	echo '<td class="nbpost">'.$nb_post.'</td>';
	echo '<td class="nbpost">'.$nb_vu.'</td>';
	echo '<td class="flag">'.$flag.'</td>';
	echo '<td class="qui">'.$ligne->login.'<br>le '.$time.'</td>';
	echo '<td class="qui">'.$ligne->lastlogin.'<br>le '.$lasttime.'</td>';
	if ($_SESSION['sess_admin'] == 'O') echo '<td class="supp"><a href="valider.php?type=suppTopic&id_topic='.$ligne->id_topic.'">Supp.</a></td>';
  echo '</tr>';
	$altern = ! $altern;
}
echo '</table>';
?>
<br>
<?php
if($_SESSION['sess_log'] != '') {
	echo '<form name="form1" method="post" action="valider.php">';
	echo '<center><b>Créer un topic :</b> - <a href="javascript:smileys()">Liste des smileys</a></center>';
	echo '<center><input type="text" name="titre" size="85"></center>';
	echo '<center><textarea name="text" cols="64" rows="10"></textarea></center>';
	echo '<center><input type="submit" name="Valider" value="Valider" onClick="return validerTopic()"></center>';
	echo '<input type="hidden" name="id_forum" value="'.$_GET['id_forum'].'">';
	echo '<input type="hidden" name="type" value="add_topic">';
	echo '</form>';
}
?>
<br>
<center><a href="index.php">Page d'accueil</a></center>
</body>
</html>
