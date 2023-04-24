<?php
require_once('fichiers_php/ConnectBDD.php');

if(!isset($_SESSION)){
  session_start();
  

}
if(isset($_SESSION['id']))
{
?>
  <script>
    window.close();
    window.location.reload();
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
        //On redirige ensuite vers la page d'accueil.
        ?>

        <script>window.close()<script>
        <?php
        header('Location: index.php');
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=1.4.2"></script>
    <script src="js/login.js"></script>
  </head>
  <body>
    <div id="container">
      <div id="loginContainer">
        <a href="#" id="loginButton"><span>Connexion</span></a>
        <div style="clear:both"></div>
          <div id="loginBox">
            <!-- Formulaire de connexion    -->
        <form method="post" id="loginForm">
          <legend>Connexion</legend>
          <fieldset id="body">
              <p><label for="pseudoco">Pseudo: </label>
                 <input type="text" name="pseudoco" placeholder="Votre pseudo" value=<?php if(isset($pseudoco)){ echo $pseudoco; } ?>></p>

                <p><label for="motdepasseco">Mot de passe: </label>
                <input type="password" name="motdepasseco" palceholder="Votre mot de passe"></p>

                <input type="submit" id="login" name="connecter" value="Se connecter">
                <input type="button" id="login" value="S'inscrire" onClick="window.location.href='inscription.php'">           
              <!--  On affiche l'erreur si l'utilisateur a mal remplie le formulaire  -->
              <?php if(isset($erreur)){ echo '<font color="red">'.$erreur.'</font>'; }?>
          </fieldset>
        </form>
        </div>
      </div>
      </div>
  </body>
</html>

<?php 
} 
?>