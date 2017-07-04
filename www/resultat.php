<?php
session_start();
include('./connect.php');
include('./fonctions.php');
UpdConnected();
?><html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>R&eacute;sultat</title>
  <style>@import url(styles.css);</style>
	<script language="javascript" src="fonctions.js"></script>
  </head>
  <body>
		<?php
			if(isset($_GET['niveau'])) {
				$sql = "SELECT DISTINCT t.*, (select titre from forums where id_forum = t.id_forum) as titreForum
								FROM topics t,posts p
								WHERE t.id_topic = p.id_topic
								AND ";

				$search = explode(' ',trim($_GET['chaine']));

				$sql .= " (t.titre LIKE '%".$search[0]."%' OR p.text LIKE '%".$search[0]."%'";
				foreach($search as $cle => $val) {
					if($cle != 0 ) $sql .= " OR t.titre LIKE '%".$val."%' OR p.text LIKE '%".$val."%'";
				}
				$sql .= ')';

				switch ($_GET['niveau']) {
					case 'tout':
						$sql .= '';
					break;
					case 'topic':
						$sql .= " AND id_forum = ".$_GET['id'];
					break;
				}

				$sql .= " ORDER BY id_forum,p.date desc";
				//die($sql);

				//Tableau de résultat
				$req = mysqli_query($lien,$sql);
				if(mysqli_num_rows($req) == 0) {
					message("Aucun r&eacute;sultat!",false,'Retour|index.php',true);
				} else {
					echo '<table class="tableau" align="center" cellpadding="0" cellspacing="0" border=1>';
					echo '<tr class="entete"><th>Titre du topic</th></tr>';
					$altern = false;
					while($ligne = mysqli_fetch_assoc($req)) {
						$class = ($altern) ? ' class="A"' : ' class="B"';
						echo '<tr'.$class.'><td>';
						echo '<a href="posts.php?id_topic='.$ligne['id_topic'].'">';
						echo mef($ligne['titre']);
						echo '</a>';
						echo '</td></tr>';
						$altern = !$altern;
					}
					echo '</table>';

					echo '<p align=center><a href="'.$_SESSION['retourRech'].'">Retour</a></p>';
				}
			}
		?>
  </body>
</html>
