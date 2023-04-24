<?php
	require("fichiers_php/affichage_histo.php");
?>
<DOCTYPE! html>
<html>
   <head>
      <meta charset="utf-8" >
      <title>Mon historique</title>
      <link rel="stylesheet" href="style_site.css">
   </head>

   	<body>
      <div id="blocPage">
           <?php include("header.php");?>
        
        <section id="corps">
          <article id="historique">
          	<?php afficher_histo_util($_SESSION['pseudo']) ?>   
          </article>
    	 </section>
      </div>
	</body>
</html>
