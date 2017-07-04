// JavaScript Document
	function checkMDP() {
		mdp = document.form1.mdp.value;
		mdp2 = document.form1.mdp2.value;
		if(mdp != mdp2) {
			document.getElementById('imgCHK').src='images/checkno.gif';
			document.getElementById('imgCHK').style.visibility='visible';
		} else {
			document.getElementById('imgCHK').src='images/checkok.gif';
			document.getElementById('imgCHK').style.visibility='visible';
		}
	}

	function majuscule(obj) {
		obj.value = obj.value.toUpperCase();
	}

	function copyToLogin(chaine) {
		if(document.form1.login.value == '') {
			document.form1.login.value = chaine.toLowerCase();
		}
	}

	function infoMDP(chaine) {
		nb = chaine.length;
		if(nb < 6) texte = 'Mot de passe trop petit';
		if(nb >= 6 && nb <=8) texte = 'Mot de passe moyen';
		if(nb > 8) texte = 'Mot de passe fort';
		document.all.spanInfo.innerHTML = texte;
	}

	function verifChamp(champ) {
		if(document.form1.elements[champ].value == '') {
			document.form1.elements[champ].style.backgroundColor = 'red';
			return false;
		} else {
			document.form1.elements[champ].style.backgroundColor = 'white';
			return true;
		}
	}


	function validationInscription() {
		//Champs obligatoires : Nom, date de naissance, login, mot de passe, au moins une case � cocher
		erreur = false;
		erreur = (verifChamp('nom')    && erreur == false) ? false : true;
		erreur = (verifChamp('login')  && erreur == false) ? false : true;
		erreur = (verifChamp('email')  && erreur == false) ? false : true;
		erreur = (verifChamp('mdp')    && erreur == false) ? false : true;
		erreur = (verifChamp('mdp2')   && erreur == false) ? false : true;

		if(erreur) document.getElementById('avert').style.visibility = 'visible';

		if(erreur) {
			return false;
		} else {
			document.form1.submit();
		}
	}

	function smileys() {
		window.open('smileys.php');
	}

	function validerTopic() {
		if(document.form1.titre.value == '' || document.form1.text.value == '') {
			alert('Il faut renseigner le titre du topic et le premier post!!');
			return false;
		} else {
			return true;
		}
	}

	function redirect(url) {
		document.location.href = url;
	}
