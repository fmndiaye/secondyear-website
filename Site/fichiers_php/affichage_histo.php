<?php
	require_once('ConnectBDD.php');
	connectbase();
	function afficher_histo_general(){ //affiche l'historique general
		$res = query("select p.pseudo, p.nom, p.date_resolution from partie p order by p.date_resolution desc limit 25;");
		echo '<table style="border-collapse: collapse">
				<tr>
					<th style="border: 1px solid white">Pseudo</th>
					<th style="border: 1px solid white">Nom</th>
					<th style="border: 1px solid white">Date</th>
				</tr>';
		while ($row = fetch($res)){

			echo '<tr>
					<td style="border: 1px solid white">'.$row['pseudo'].'</td>
					<td style="border: 1px solid white">'.$row['nom'].'</td>
					<td style="border: 1px solid white">'.$row['date_resolution'].'</td>
					</tr>';

		}
		echo '</table>';
	}
	function afficher_histo_util($pseudo_util){ //affiche l'historique de l'utilisateur
		$res = query("select p.pseudo, p.nom, p.date_resolution from partie p where  p.pseudo='{$pseudo_util}' order by p.date_resolution desc limit 25;");
			echo '<table style="border-collapse: collapse">
					<tr>
						<th style="border: 1px solid white">Pseudo</th>
						<th style="border: 1px solid white">Nom</th>
						<th style="border: 1px solid white">Date</th>
					</tr>';
			while ($row = fetch($res)){

				echo '<tr>
						<td style="border: 1px solid white">'.$row['pseudo'].'</td>
						<td style="border: 1px solid white">'.$row['nom'].'</td>
						<td style="border: 1px solid white">'.$row['date_resolution'].'</td>
						</tr>';

			}
			echo '</table>';
	}















?>
