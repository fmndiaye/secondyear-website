<?php
	require_once('fichiers_php/Genie.php');
	require_once('fichiers_php/Genie_exact.php');
	require_once('fichiers_php/ConnectBDD.php');
	session_start();
	$obj = $_SESSION['obj'];
	$reponse = $obj->reponse;
	if ($reponse==null){
		header('Location: jeu.php');
	}
	$img = "png/{$reponse}.png";
	$faux=true;
	if (isset($_POST['ouirep']) OR isset($_POST['nonrep'])){
		if (isset($_POST['ouirep'])){
			date_default_timezone_set("Europe/Paris");
			$pseudo = $_SESSION['pseudo'];
			var_dump($pseudo);
			$date = date('Y-m-d H:i:s');
			$req = "insert into partie(pseudo, nom, date_resolution) values('{$pseudo}', '{$obj->reponse}', '{$date}');";
			// var_dump($req);
			query($req);
			//pg_query($req);
			$req = "delete from match where pseudo='{$pseudo}';";
			query($req);
			header("Location: index.php");
		}
		else{
			$faux = false;
		}
	}
	$pays_erreur=false;
	if (isset($_POST['envoyer'])){
		$pays = htmlspecialchars($_POST['pays']);
		$pays_app = $obj->pays_appartient($pays);
		if ($pays_app==false){
			$test = "({$pays} n'existe pas)";
			$faux=false;
		}
		else{
			$pays_erreur = true;
			$faux=false;
		}
	}
?>


<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Résultat</title>
   <link rel="stylesheet" href="style_site.css">
</head>
<?php include("header.php"); ?>
<body>
	<img src="img/Genie.png" class="genie">
	<div >
		<?php if ($faux==true){ ?>
		<form method="post">
			<?php if (file_exists($img)){ ?>
			<img src=<?php echo $img; ?> class="drapeau">
			<?php }else{ 
				?>
			<img src="bulle.png" class="bulle">
			<div id='question'><legend>Est-ce <?php echo $obj->reponse; ?></legend></div>
			<?php }?>

			<input type=submit class="bouttonoui" name="ouirep" value="Oui">
			<input type=submit class="bouttonnon" name="nonrep" value="Non">
		</form>
	

		<?php }else{ ?>
		
		<form method="post">
			<img src="bulle.png" class="bulle">
			<div id='question'><legend>Quel pays cherchiez vous ? <?php if (isset($test)){ echo $test; } ?></legend>
			<input type="text" name="pays" placeholder="Le pays"></div>
			<input type=submit class="bouttonoui" name='envoyer' value='envoyer'>
		</form>
		<div id='afficher' style='position: absolute; top:75%; left:15%; font-family: DejaVu Sans Mono, monospace; font-size: 30px;'><?php if ($pays_erreur==true){ $obj->afficher_pays($pays);$pseudo=$_SESSION['pseudo']; $req = "delete from match where pseudo='{$pseudo}';";query($req); }?>
		<?php } ?>
		</div>
	</div>
</body>
</html>
