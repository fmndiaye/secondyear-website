<?php
require_once('fichiers_php/ConnectBDD.php');
connectbase();

include('header.php'); 

if(isset($_GET['id']) AND $_GET['id'] > 0){
$req = "SELECT *
        FROM utilisateur
        WHERE id = {$_GET['id']}";
        //requete sql^
$result = query($req) or die('Erreur SQL!'.$req.'<br>'.fetch_erreur()); //on affiche les érreurs SQL
$data = fetch_assoc($result);
 }
?>
<html>
   <head>
      <title>Votre Profil</title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style_site.css">
   </head>
   
   <body>
      <div id="bloc-Page">
         <section id="corps">
            <article id="profil" style='text-align:center;margin-top: 10%;'>
               <table>
                  <tr>
                     <td>Profil de:</td>
                     <td><?php echo $data['pseudo']; ?></td>
                  </tr>
                  <tr>
                     <td>Pseudo:</td>
                     <td><?php echo $data['pseudo']; ?></td>
                  </tr>
                  <tr>
                     <td>Email:</td>
                     <td><?php echo $data['email']; ?></td>
                  </tr>
                  <tr>
                     <td>Date de naissance:</td>
                     <td><?php echo $data['naissance']; ?></td>
                  </tr>
               </table>
               <?php
                  if(isset($_SESSION['pseudo']) AND $data['pseudo'] == $_SESSION['pseudo'])
                  {
                     ?>
               <br/>
               <a href="mdp.php"><input type="button" value="Changer de mot de passe"/></a>
               <a href="mailchange.php"><input type="button" value="Changer d'adresse email"/></a>
               <a href="deconnexion.php"><input type="button" value="Deconnexion"/></a>
               <?php
                  }
                     ?>
            </article>
         </section>
      </div>
   </body>
</html>
