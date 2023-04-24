<?php
require_once('fichiers_php/ConnectBDD.php');
connectbase();

session_start();

if(isset($_POST['start'])){
  if (isset($_POST['oldmdp']) && isset($_POST['mdp1']) && isset($_POST['mdp2'])){
    if($_POST['mdp1']==$_POST['mdp2']){
      $reqmdp = "select * from utilisateur where pseudo ='{$_SESSION{'pseudo'}}';";
      
      $resmdp = query($reqmdp);
  
      $row_mdp = fetch($resmdp);
      $oldmdp = htmlspecialchars($_POST['oldmdp']);
      if(password_verify($oldmdp, $row_mdp['mdp'])){
        $mdp1 = htmlspecialchars($_POST['mdp1']);
        $mdp1 = password_hash($mdp1, PASSWORD_DEFAULT);
        
        echo $_SESSION['pseudo'];
        query("update utilisateur set mdp='{$mdp1}' where pseudo='{$_SESSION['pseudo']}'");
        // header("Location: profil.php?id={$_SESSION['id']}");

      }
      else{
        $erreur = "Ancien mot de passe invalide";
      }
      
    }
    else{
      $erreur = "mot de passes différents";
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
                     <legend>Changer votre mot de passe:</legend>
                        <p><label for="oldmdp">Ancien mot de passe:</label><input type="password" name="oldmdp" placeholder="Votre ancien mot de passe"></p>
                        <p><label for="mdp1">Nouveau mot de passe:</label><input type="password" name="mdp1" placeholder="Votre mot de passe"></p>
                        <p><label for="mdp2">Confirmation nouveau mot de passe:</label><input type="password" name="mdp2" placeholder="Confirmation du mot de passe"></p>
                        <p><input type='submit' name='start' value='Confirmer la modification'></p>
                         <?php if(isset($erreur)){ echo '<font color="red">'.$erreur.'</font>'; } ?>
                  </fieldset>
               </form>
            </article>
         </section>
               
            
      </div>
   </body>
</html>




