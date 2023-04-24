<?php
	session_start();
 ?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title> Contact</title>
  <link rel="stylesheet" href="style_site.css">
</head>

<body>
	<div id="blocPage">
		<?php include("header.php");?>

		<section id="corps">
			<article>
				<?php include("mail.php");?>	
			</article>
		</section>
	
	</div>
</body>
</html>
