<?php
require_once('fichiers_php/ConnectBDD.php');
if(!isset($_SESSION)){
  session_start();

}
if(isset($_SESSION['id']))
{
?>
  <script>
    window.location.replace('index.php');
  </script>
<?php
}
else
{
//On se connecte a la base de donnée.
connectbase();
//Démarre le test de connexion si l'utilisateur appuie sur connecter.
if(isset($_POST['connecter'])){
  $pseudoco=htmlspecialchars($_POST['pseudoco']);
  //On vérifie si les champs sont biens remplis.
  if(!empty($_POST['pseudoco']) AND !empty($_POST['motdepasseco']))
  {
    //On fait une requete pour savoir si le pseudo et le mot de passe appartiennent a la bdd.
    $requser = "select count(*) from utilisateur where pseudo ='{$pseudoco}';";
    $resuser = query($requser);
    $rowuser = fetch($resuser);
    if($rowuser[0]==1)
    {
      $reqmdp = "select * from utilisateur where pseudo ='{$pseudoco}';";
      $resmdp = query($reqmdp);
      $row_mdp = fetch($resmdp);
      $motdepasseco = htmlspecialchars($_POST['motdepasseco']);
      if(password_verify($motdepasseco, $row_mdp['mdp']))
      {
        //On enregistre dans la variable global SESSION qu'on récupère avec session_start().
        $_SESSION['id']=$row_mdp['id'];
        $_SESSION['pseudo']=$row_mdp['pseudo'];
        $_SESSION['email']=$row_mdp['email'];
        $_SESSION['naissance']= $row_mdp['naissance'];
        header('Location: index.php');
        //On redirige ensuite vers la page d'accueil.
      }
      else
      {
        $erreur="Mauvais mot de passe";
      }
    }
    else
    {
      $erreur = "Ce pseudo n'existe pas";
    }
  }
  else
  {
    $erreur="Tout les champs doivent être complétés.";
  }
}



?>




<DOCTYPE! html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style_site.css">
  </head>

  <body>
    <?php include('header.php'); ?>
    <div id="blocPage">
    <section id="corps">
      <center>
        <article id="connexion">
          <form  method="post">
            <fiedset>
              <legend>Connexion</legend>
                <!-- Formulaire de connexion    -->
                <p><label for="pseudoco">Pseudo: </label><input type="text" name="pseudoco" placeholder="Votre pseudo" value=<?php if(isset($pseudoco)){ echo $pseudoco; } ?>></p>
                <p><label for="motdepasseco">Mot de passe: </label><input type="password" name="motdepasseco" palceholder="Votre mot de passe"></P>
                <input type="submit" name="connecter" value="Se connecter">
                <input type="button" value="S'inscrire" onClick="window.opener.location.href='inscription.php';window.close(); return false;"/> 
                
                <!--  On affiche l'erreur si l'utilisateur a mal remplie le formulaire  -->
                <?php if(isset($erreur)){ echo '<font color="red">'.$erreur.'</font>'; }?>
            </fieldset>
          </form>
        </article>
        </center>
    </section>
    </div>
  </body>
</html>

<?php 
} 
?>