<?php
  session_start();
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Contact</title>
  <link rel="stylesheet" href="style_site.css">
</head>

<body>
	<div id="blocPage">
		<!-- HEADER: inclus logo du site, menu utilisateur ainsi que le menu de navigation-->
		<?php include("header.php");?>

		<!-- CORPS: inclus 2 éléments qui dépendent de la page-->
		<section id="corps">
			<article id="contact">
          
          <!-- Formulaire pour envoyer le mail de contact.-->
            <form method="POST" action="contactrep.php">
            <fieldset>
            <legend>Formulaire de contact:</legend>
                <p><label for="nom">Nom* : </label><input type="text" name="nom" id="nom" ></p>
                <p><label for="email">E-Mail* : </label><input type="email" name="email" id="email"></p>
                <p><label for="objet">Objet* : </label><input type="text" name="objet" id="objet"></p>
                <p><label for="message">Message* : </label><textarea type="text" name="message" id="message" rows="8" cols="40"></textarea></p>
                <input type="submit" name="envoi" value="Envoyer le formulaire !">
                <h6 style="text-decoration: underline;">Tous les champs marqués d'un astérisque * sont obligatoires.</h3>
                </fieldset>
            </form>

          </article>
		</section>
