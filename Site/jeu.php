<?php
  require_once('fichiers_php/Genie.php');
  require_once('fichiers_php/Genie_exact.php');
  if (!isset($_SESSION)){ session_start(); }
  if (!isset($_SESSION['obj'])){ header('Location: index.php');}
  $obj =$_SESSION['obj'];
   
?>



<DOCTYPE! html>
<html>
   <head>
      <meta charset="utf-8" >
      <title>Jeu</title>
      <link rel="stylesheet" href="style_site.css">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      
   </head>
  <?php include("header.php");?>
   <body>    
      <div id="loader" style="display:none" ><img src="images/ajax-loader.gif" class='load' alt="load"/></div>
      <div class="bloc-Page">
        <img src="img/Genie.png" class="genie">
        <img src="bulle.png" class="bulle">
        <form method="post" id='form_genie'>
          <label><div id='question'><?php $obj->getQuestion(); ?></div></label>
           
           <div id='bouttons'>
            <input type="button" class="bouttonoui" id='oui' value="Oui">
            <input type="button" class="bouttonnon" id='non' value="Non">
           </div>
        </form>
      </div>
   </body>
   <script type='text/javascript'>
        $(function(){
            $('#oui').click(function(){
                $("#loader").show();
                reponse = 'oui';
                $.post(
                  "reponse_ajax.php",
                  {
                    reponse:reponse
                  }, 
                  function(data){
                    if (data == 'ok'){
                      window.location.replace('resultat.php');
                    }
                    else{
                      $("#question").empty().hide();
                      $("#question").append(data);
                      $("#question").show();
                    }
                    $("#loader").hide();
                 
                },
                'text'

                );

                return false;
            });
            $('#non').click(function(){
               $("#loader").show();
                reponse = 'non';
                 $.post(
                    "reponse_ajax.php",
                    {
                      reponse:reponse
                    }, 
                    function(data){
                      if (data == 'ok'){
                        window.location.replace('resultat.php');
                      }
                      else{
                        $("#question").empty().hide();
                        $("#question").append(data);
                        $("#question").show();
                      }
                      $("#loader").hide();
                   
                  },
                  'text'

                  );
                return false;
            });
        });
    </script>
   </html>
