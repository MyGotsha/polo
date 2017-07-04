<?php
function formatDate($str) {

	$annee = substr($str,0,4);
	$mois = substr($str,5,2);
	$jour = substr($str,8,2);
	$heure = substr($str,11,2);
	$minute = substr($str,14,2);
	$secondes = substr($str,17,2);

	$str = $jour.'/'.$mois.'/'.$annee.' &agrave; '.$heure.':'.$minute.':'.$secondes;

	return $str;
}

function formatText($str) {
	if($mq == false) {
		$str = addslashes(nl2br($str));
	}
	return $str;
}

//Met en forme le texte pour l'affichage
function mef($str) {
  //retours à la ligne HTML
	$str = nl2br($str);

  //Affichage des smileys
  $dossier = 'images/smileys/';
	$d = opendir($dossier);
	while(($fichier = readdir($d)) !== false) {
		if(ereg('[a-zA-Z0-9]*\.(GIF|gif)',$fichier) !== false) {
			$tabCode[] = ':'.substr($fichier,0,strlen($fichier)-4).':';
			$tabImg[] = '<img src="'.$dossier.$fichier.'" border="0">';
		}
	}

	$str = str_replace($tabCode,$tabImg,$str);

  return $str;
}

function genCode() {
	$_SESSION['code'] = '';
	$code = '';
	for($i=0;$i<=5;$i++) {
		$code.= rand(0,9);
	}
	$_SESSION['code'] = $code;
}


//Affiche un message formaté à l'écran.
//$texte : Texte explicatif
//$stop : Est ce qu'on arrête le script
//$lien : lien généré au format libellé|url
function message($texte,$stop = false,$lien = '',$auto = true) {

	$chaine = '<p class="message">'.$texte.'</p>';
	if($lien != '') {
		$li = explode('|',$lien);
		$chaine .= '<p align="center"><a href="'.$li[1].'">'.$li[0].'</a></p>';
	}

	if($auto) {
		$chaine .= '<script language="javascript">';
		$chaine .= 'window.setTimeout("redirect(\''.$li[1].'\')",3000);';
		$chaine .= '</script>';
	}

	if($stop) {
		die($chaine);
	} else {
		echo $chaine;
	}
}

function genActivationCode() {
	$code = '';
	for($i=0;$i<10;$i++) {
		$code.= rand(0,9);
	}
	return $code;
}

function genereMail($f_type,$f_param) {

	global $lien;

	$sujet = 'Inscription au forum';
	$modele = file_get_contents('mailInscription.html');
	$f_param['CODE'] = genActivationCode();

	$sql = "UPDATE users SET code='".$f_param['CODE']."' WHERE login='".$f_param['login']."'";
	$req = mysqli_query($lien,$sql);

	foreach($f_param as $cle => $valeur) {
		$modele = str_replace('#'.strtoupper($cle).'#',$valeur,$modele);
	}
	$corps = $modele;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	if(!mail($f_param['to'],$sujet,$corps,$headers)) {message('Mail non envoyé!',true);}
}

function recherche($niveau,$id = '') {
	/*
	Niveaux :
	- tout -> tous les forums
	- topic -> sur un topic
	*/
	$idstr = ($id == '') ? '' : '&id='.$id;

	$str  = '<form name="formrech" method="GET" action="resultat.php">';
	$str .= '<table>';
	$str .= '<tr><td>';
	$str .= '<input type="text" name="chaine">';
	$str .= '<input type="hidden" name="niveau" value="'.$niveau.'">';
	if($id != '') $str .= '<input type="hidden" name="id" value="'.$id.'">';
	$str .= '<input type="submit" name="rechercher" value="Rechercher" onClick="if(formrech.chaine.value == \'\') return false;">';
	$str .= '</td></tr>';
	$str .= '</table>';
	$str .= '</form>';

	return $str;
}

function UpdConnected() {
	global $lien;

	if($_SESSION['sess_log'] != '') {
		$sql = "UPDATE users SET dateaction=CURRENT_TIMESTAMP, ip='".$_SERVER['REMOTE_ADDR']."' WHERE login='".$_SESSION['sess_log']."'";
		$req = mysqli_query($lien,$sql);
	}
}

function afficheConnected() {
	global $lien;

	$ret = '';
	$sql = "select login,ip
					from users
					where TIME_TO_SEC(timediff(CURRENT_TIMESTAMP,dateaction)) < 60";
	$req = mysqli_query($lien,$sql);
	$sep = '';
	while($li = mysqli_fetch_assoc($req)) {
		$spanG = '<span title="Depuis '.$li['ip'].' ('.gethostbyaddr($li['ip']).')">';
		$spanD = '</span>';
		$ret .= $sep.$spanG.$li['login'].$spanD;
		$sep = ',';
	}
	return $ret;
}


?>
