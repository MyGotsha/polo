<?php
session_start();
include('./connect.php');
include('./fonctions.php');
genCode();
UpdConnected();
?>
<html>
<head>
<title>Inscription</title>
<style>@import url(styles.css);</style>
<script language="javascript" src="fonctions.js"></script>
</head>

<body>
<form name="form1" method="POST" action="valider.php">
  <table align="center">
    <tr>
      <th colspan="2">Veuillez entrer les informations n&eacute;cessaires :</th>
    </tr>
    <tr>
      <td class="lib">Nom pr&eacute;nom :</td>
      <td>
        <input type="text" name="nom" onBlur="majuscule(this);copyToLogin(this.value);">
        <input type="text" name="prenom">
      </td>
    </tr>
    <tr>
      <td class="lib">Email :</td>
      <td><input type="text" name="email"></td>
    </tr>
    <tr>
      <td class="lib">Login :</td>
      <td><input type="text" name="login" size="15" maxlength="15"></td>
    </tr>
    <tr>
      <td class="lib">Mot de passe :</td>
      <td>
        <input type="password" name="mdp" size="10" maxlength="10" onkeyup="infoMDP(this.value);checkMDP();">&nbsp;
        <span id="spanInfo"></span>
      </td>
    </tr>
    <tr>
      <td class="lib">Confirmation :</td>
      <td>
        <input name="mdp2" type="password" size="10" maxlength="10" onkeyup="checkMDP();">
        <img id="imgCHK" src="images/checkno.gif" align="absmiddle" style="visibility:hidden;">
      </td>
    </tr>
    <tr>
      <td class="lib">Code de s&eacute;curit&eacute; :</td>
      <td>
        <img id="imgCHK" src="genCode.php" title="Si le code est illisible, veuillez recharger la page."><br />
		<input name="code" type="text" size="7" maxlength="6">
      </td>
    </tr>
    <tr>
      <td colspan="2" align="right">
        <input type="hidden" name="type" value="inscription">
        <input type="reset" name="Vider" value="Vider les champs">
        <input type="button" name="Valider" value="Valider" onClick="validationInscription()">
      </td>
    </tr>
  </table>
</form>
<br>
<center><a href="index.php">Page d'accueil</a></center>
<div id="avert" class="avert" onClick="this.style.visibility='hidden';" style="visibility: hidden;">
Des champs obligatoires n'ont pas &eacute;t&eacute; remplis!!<br>
Ceux-ci sont maintenant color&eacute;s en rouge. Veuillez compl&eacute;ter ces informations.
</div>
</body>
</html>
