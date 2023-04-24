<?php

require_once('fichiers_php/ConnectBDD.php');
connectbase();

session_start();

if(isset($_POST['start'])){
  if (isset($_POST['email1']) && isset($_POST['email2'])){
    if($_POST['email1']==$_POST['email2']){
      $mail1 = htmlspecialchars($_POST['email1']);
      $mail2 = htmlspecialchars($_POST['email2']);

      $res = query("select count(*) from utilisateur where email='{$mail1}';");
      //pg_query("select count(*) from utilisateur where email='{$mail1}';");
      $row = fetch($res);
      if($row[0]>0){
        $erreur = "Cette email est déjà utilisée";
      }
      else{
        
        query("update utilisateur set email='{$mail1}' where pseudo='{$_SESSION['pseudo']}';");

        //pg_query("update utilisateur set email='{$mail1}' where pseudo='{$_SESSION['pseudo']}';");
        header("Location: profil.php?id={$_SESSION['id']}");
      }
    }
    else{
      $erreur = "emails différents";
    }
  }
  else{
    $erreur = "Veuillez remplir les deux champs";
  }
}

?>
<html lang='fr'>
   <head>
       <meta charset='utf-8'>
      <title>Changer d'adresse email</title>
      <link rel='stylesheet' href='style_site.css'>
   </head>
   <body>
    <div id="blocPage">
         <?php include("header.php");?>
      
         <section id="corps">
           

            <article id="inscription">
               <form method="post">
                  <fieldset>
                     <legend>Changer son adresse mail:</legend>
                        <!-- Formulaire d'inscription -->
                        <p><label for="email1">Email:</label><input type="email" name="email1" placeholder="Votre email."></p>
                        <p><label for="email2">Confirmation Email:</label><input type="email" name="email2" placeholder="Confirmation de l'email"></p>
                        <p><input type='submit' name='start' value='Confirmer la modification'></p>
                         <?php if(isset($erreur)){ echo '<font color="red">'.$erreur.'</font>'; } ?>
                  </fieldset>
               </form>
            </article>
         </section>
               
            
      </div>
   </body>
</html>


