<?php 
	
	require_once('fichiers_php/ConnectBDD.php');
	connectbase();
	require('fichiers_php/Genie.php');
   require('fichiers_php/Genie_exact.php');
   if (!(isset($_SESSION))){ session_start(); }
   if (!(isset($_SESSION['pseudo']))){
      $id = rand(10000,99999);
      $pseudo = "Guest{$id}";
      $_SESSION['pseudo']=$pseudo;
   }
   else{
      $pseudo = $_SESSION['pseudo'];
   }
 
	if (isset($_POST['lancer'])){
      $tableau = [];
      $tableau[] = "couleur";  $tableau[] = "pays_couleurs";
      $tableau[] = "forme";    $tableau[] = "pays_formes";
      $tableau[] = "symbole";  $tableau[] = "pays_symboles";
      $obj = new Genie("pays",2,$pseudo, $tableau,0.2);
      $obj->poser();
      $_SESSION['obj'] = $obj;
		header("Location: jeu.php");
	}
   if (isset($_POST['lancer2'])){
      $tableau = [];
      $tableau[] = "medaille";  $tableau[] = "sportifs_medailles";
      $tableau[] = "epreuve";    $tableau[] = "sportifs_epreuves";
      $tableau[] = "compet";  $tableau[] = "sportifs_compets";
      $obj = new Genie_exact("sportifs",1,$pseudo, $tableau);
      $obj->poser();
      $_SESSION['obj'] = $obj;
      header("Location: jeu.php");
   }
?>
<html>
   <head>
      <title>Accueil</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style_site.css">
   </head>
   
   <body>
   	<?php include('header.php') ?>
      <div class="bloc-Page">
         <img src="img/Genie.png" class="genie">
         <img src="bulle.png" class="bulle">
         <section id="corps">
            <article id="test">
               <form method="post">
					 <div id='question'><legend>Démarrer la partie</legend></div>
					 <input type=submit class="bouttonoui" name="lancer" value="Pays">
                <input type=submit class="bouttonnon" name="lancer2" value="Athletes JO">
				   </form>
            </article>
         </section>
      </div>
   </body>
</html>
