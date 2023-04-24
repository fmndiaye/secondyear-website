<?php
	session_start();
	if(isset($_POST['submit_commentaire'])){
		if(isset($_POST['pseudo'],$_post['commentaire']) AND !empty($_post['pseudo']) AND !empty($_post['commentaire'])){
			$commentaire = htmlspecialchar($_POST['commentaire']);
		} else {
				$c_erreur = "Tous les champs doivent être complétés";
		}
	}
?>



<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Z&V Project: Contact</title>
  <link rel="stylesheet" href="style_site.css">
</head>

<body>
	<div id="blocPage">
		<!-- HEADER: inclus logo du site, menu utilisateur ainsi que le menu de navigation-->
		<?php include("header.php");?>
    <h2>Commentaires:</h2>
		<from method="POST">
				<textarea name="commentaire" planeholder="Votre commentaire..."></textarea><br />
				<input type="submit" value="Poster mon commentaire" name="submit_commentaire" /> 
		</from>

<?php
	if(isset($c_erreur)) { echo " erreur :" .$c_erreur;}
?> 
