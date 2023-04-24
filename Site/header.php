<?php
if (!isset($_SESSION)){
	session_start();
}

//ici car le header est inclut sur toutes les pages, donc la session et le footer sera sur toutes les pages	

if(isset($_SESSION['id']))
{
	?>
	<header>
		<div id="navigation">
			<nav>
				<ul>
					<li><a href="index.php">Accueil</a></li>

					<li><a href="deconnexion.php">Déconnexion</a></li>
					<li><a href='profil.php?id= <?php echo $_SESSION['id']; ?>'>Profil</a></li>
					<li><a href='historique.php'>Historique</a></li>
					<li><a href="historique_util.php">Historique(Personnel)</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<?php
}
else
{
	if (!(isset($_SESSION['pseudo']))){
	$id = rand(10000,99999);
	$pseudo = "Guest{$id}";
	$_SESSION['pseudo']=$pseudo;
	}
	
?>
<script>
function popup(page) {
	window.open(page, 'connexion', 'resizable=no, location=no, width=400, height=300, menubar=no, status=no, scrollbars=no, menubar=no');
}

</script>
	<header>
	<div id="navigation">
	
		<nav>
			<ul>
				<li><a href="inscription.php">Inscription</a></li>
				<li><?php include('connexion.php'); ?></li>
				<li><a href="index.php">Accueil</a></li>
				<li><a href='historique.php'>Historique</a></li>
				<li><a href="historique_util.php">Historique(Personnel)</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</div>
</header>
<?php
}
?>
