<?php
	require("fichiers_php/affichage_histo.php");
  if (isset($_POST['histo'])){
    header('Location: historique_util.php');
  }
?>
<DOCTYPE! html>
<html>
   <head>
      <meta charset="utf-8" >
      <title>Historique</title>
      <link rel="stylesheet" href="style_site.css">
   </head>

   	<body>
      <div id="blocPage" >
           <?php include("header.php");?>
        
        <section id="corps" >
          <article id="historique" >
          	<?php afficher_histo_general(); ?>   
          </article>
  
    	 </section>
      </div>
	</body>
</html>