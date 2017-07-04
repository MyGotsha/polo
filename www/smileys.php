<?php
session_start();
include('./connect.php');
include('./fonctions.php');
UpdConnected();
?>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <title>Liste des smileys</title>
  <style>@import url(styles.css);</style>
	<script language="javascript" src="fonctions.js"></script>
	<script language="javascript">
		function go(code) {
			window.opener.document.form1.text.value = window.opener.document.form1.text.value+code;
			window.close();
		}
	</script>
  </head>
  <body>
  	<h1>Liste des smileys</h1>
		<?php
			$nbx = 7;
			$dossier = 'images/smileys/';
			$d = opendir($dossier);
			$compteur = 1;
			echo '<table align="center">';
			while(($fichier = readdir($d)) !== false) {
				if(ereg('[a-zA-Z0-9]*\.(GIF|gif)',$fichier) !== false) {
					if((($compteur-1) % $nbx) == 0) echo '<tr>';
					$code = ':'.substr($fichier,0,strlen($fichier)-4).':';
					echo '<td>';
					echo '<table width="100%"><tr><td align=center>';
					echo '<a href="javascript:go(\''.$code.'\')"><img src="'.$dossier.$fichier.'" border=0 title="'.$code.'"></a>';
					echo '</td></tr><tr><td align=center>';
					echo $code;
					echo '</td></tr></table>';
					echo '</td>';
					if(($compteur % $nbx) == 0) echo '</tr>';
					$compteur++;
				}
			}
			echo '</table>';
		?>
  </body>
</html>
