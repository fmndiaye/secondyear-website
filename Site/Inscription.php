<?php
require_once('fichiers_php/ConnectBDD.php');
connectbase();

include("header.php");
if(isset($_SESSION['id']))
{
   header("Location: index.php");
}
else
{


//On effectue la suite si l'utilisateur appuye sur inscription.
if (isset($_POST['inscription'])) 
{
   //On créer les variables
   $pseudo=htmlspecialchars($_POST['pseudo']);
   $pseudo=str_replace(' ', '', $pseudo);
   $email=htmlspecialchars($_POST['email']);
   $anniversaire = htmlspecialchars($_POST['anniversaire']);
   $motdepasse=password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);
   //On vérifie si tout les chmps ont été remplis.
   if (!empty($pseudo) AND !empty($email) AND !empty($_POST['motdepasse']) AND !empty($_POST['anniversaire']) AND !empty($_POST['motdepasse2']))
   {
      //on vérifie si l'email est un email conforme
      if(filter_var($email,FILTER_VALIDATE_EMAIL))
      {
         //On vérifie si les mots de passent correspondent.
         if($_POST['motdepasse']==$_POST['motdepasse2'])
         {
   
               $reqmail = "select count(*) from utilisateur where email ='{$email}';";
               
               $resmail = query($reqmail);
               //pg_query($reqmail);
               $row_mail = fetch($resmail);
               //On vérifie si l'email est deja utilisée.
               if($row_mail[0] == 0)
               {
                  $reqpseudo = "select count(*) from utilisateur where pseudo ='{$pseudo}';";
                  $respseudo = query($reqpseudo);
                  //pg_query($reqpseudo);
                  $row_pseudo = fetch($respseudo);
                  //On vérifie si le pseudo est déja utilisé.
                  if($row_pseudo[0] == 0)
                  { 
                     //Si tout les test sont passés, ajoute dans la base de donnée.
               
                     $reqinsert = "insert into utilisateur(pseudo,mdp,email,naissance) values ('{$pseudo}','{$motdepasse}','{$email}','{$anniversaire}');";
                     $resinsert = query($reqinsert);
                     //pg_query($reqinsert);
                     $bool=True;
                  }
                  else
                  {
                     $erreur = "Le pseudo est déja utilisé";
                  }
               }
               else
               {
                  $erreur = "L'email est déja utilisée";
               }
               
         }
         else
         {
            $erreur = "Les mot de passes ne correspondent pas";
         }
      }
      else
      {
         $erreur="Email non valide";
      }
   }
   else
   {
   $erreur = "Tous les champs doivent être remplis.";
   }
   
}
?>







<DOCTYPE! html>
<html>
   <head>
      <meta charset="utf-8" >
      <title>Inscription</title>
      <link rel="stylesheet" href="style_site.css">
   </head>

   <body>
      <div id="blocPage">
         <?php //include("header.php");?>
      
         <section id="corps">
            <article id="inscription">
               <form method="post">
                  <fieldset>
                     <legend>Inscription:</legend>
                        <!-- Formulaire d'inscription -->
                        <p><label for="pseudo">Pseudo:</label><input type="text" name="pseudo" placeholder="Votre pseudo." value=<?php if (isset($pseudo)){ echo $pseudo;} ?> ></p>
                        <p><label for="email">Email:</label><input type="email" name="email" placeholder="Votre email." value=<?php if (isset($email)){ echo $email;} ?> ></p>
                        <p><label for "anniversaire">Date de naissance:</label><input type="date" name="anniversaire" value=<?php if (isset($anniversaire)){ echo $anniversaire; }?>/></p>
                        <p><label for="motdepasse">Votre mot de passe:</label><input type="password" name="motdepasse" placeholder="Votre mot de passe." ></p>
                        <p><label for="motdepasse2">Confirmation du mot de passe:</label><input type="password" name="motdepasse2" placeholder="Confirmation du mot de passe" ></p>
                        <input type="submit" name="inscription" value="S'inscrire">
                        <?php
                           
                           if(isset($bool) AND $bool){

                              ?>
                        <a href="connexion2.php" ><input type="button" value="Connectez vous !"></a>
                        <?php
                           }
                        ?>
                        <!-- Affiche l'erreur si elle est initialisée -->
                        <?php if(isset($erreur)){ echo '<font color="red">'.$erreur.'</font>'; } ?>
                  </fieldset>
               </form>
            </article>
         </section>
      </div>

   </body>
   </html>

<?php
}
?>