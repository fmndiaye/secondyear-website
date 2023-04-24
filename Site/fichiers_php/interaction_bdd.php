<?php
	require_once('ConnectBDD.php');
	require_once('Tables.php');
	require_once('fonctions_diverses.php');
	connectbase();

class BDD{
	//liste des attributs que nous avons besoin pour communiquer avec la base
	private $tables;
	private $table;
	private $pseudo;
	private $seuil;

	function __construct($table, $pseudo, $seuil){
		$this->table=$table;
		$this->pseudo=$pseudo;
		$this->seuil=$seuil;
	}
	public static function colonnes($table){
		$req = "select column_name as colonnes from information_schema.columns where table_name='{$table}';";
		$res = query($req);
		$tab = [];
		while ($row = fetch($res)){
			$tab[] = $row[0];
		}
		return $tab;
	}
	
	function get_prefixe($StringCol, $attrb_aux){
		$res = query("select prefixe from prefixe p, questions_prefixes where id=id_prefixe and colonne='{$StringCol}';");
		$row = fetch($res);
		$questionGenere = $row[0] . ' ' . $attrb_aux;
		return $questionGenere;
	}
	function compter_restants(){
		$req = "select count(distinct id_table) from match where pseudo='{$this->pseudo}' and poids>{$this->seuil}";
		$res = query($req);
		$row = fetch($res);
		return (integer)$row[0];
	}
	function reponse(){
		$req = "select nom, poids from match, {$this->table} where id_table=id and poids >= (select max(poids) from match where pseudo='{$this->pseudo}')";
		$res = query($req);
		$row = fetch($res);
		return $row[0];
	}
	function genererQuestion($tables, $req, $historique){
		$aux = $this->retirer_historique($historique);
		$req = "select * from ({$req}) as req";
		$req .= $aux;

		return $this->optimiser_dicho($tables, $req);
	}
	function optimiser_dicho($tables, $req){
		$req_final = "";
		$res_ligne = query($req);
		$i=0;
		while ($ligne = fetch($res_ligne)){
			if ($i!=0){
			$req_final .=" UNION ";
			}$i++;
			$StringCol = $ligne[0];
			$attrb = $ligne[1];
			$attrb = double_apo($attrb);
			$test = $this->avoir_la_req($tables, $StringCol, $attrb,true); 
			
			$req_oui = "
			select sum(m.poids) as Q_oui, (select sum(m2.poids)
			from match m2
			where m2.pseudo='{$this->pseudo}' and m2.poids>{$this->seuil}) as somme_poids
			from match m, {$this->table} p 
			where p.id=m.id_table and 
			m.pseudo='{$this->pseudo}' and m.poids>{$this->seuil} and {$test};
			";
			$res_oui = query($req_oui);
			$row_oui = fetch($res_oui);
			$somme_oui = $row_oui[0];
			$somme_non = $row_oui[1]-$somme_oui;
			
			
			$req_final .= "select '{$StringCol}' as col, '{$attrb}' as attrb, ABS({$somme_oui}-{$somme_non}) as ecart";
		}
		$req_final .= " order by ecart";
		$res = query($req_final);
		$row = fetch($res);
		return $row;
	}
	function reduire_poids($tables, $StringCol, $attrb, $bool){
		$reponse = $this->avoir_la_req($tables, $StringCol, $attrb, $bool);
		$req = "update match set poids=poids::float/2::float where id_table not in (select id from {$this->table} where {$reponse}) and pseudo='{$this->pseudo}'";
		query($req);
	}
	function appartient_table($obj){
		$res = query("select count(*) from {$this->table} where nom='{$obj}';");
		$row = fetch($res);
		return $row[0]!='0';
	}
	function avoir_la_req($tables, $StringCol, $attrb, $bool){
		$aux = $tables->appartient_a_table_simple($StringCol);
		$comp="";
		if ($aux==true){
			if ($bool==true){ $comp ="="; }
			else{ $comp="<>"; }
			$test = " {$StringCol}{$comp}'{$attrb}'";
		}
		else{
			if ($bool==true){ $comp = "in"; }
			else{ $comp = "not in"; }
			//faut recuper tab_objet et tab_liaison
			$tab_liaison = $tables->get_tab_liaison($StringCol);
			$tab_objet = $tables->get_tab_objet($StringCol);
			$test = "id {$comp} (select x.id_{$this->table} from {$tab_liaison} x, {$tab_objet} y where y.{$StringCol}='{$attrb}' and y.id=x.id_{$tab_objet}) ";
		}
		return $test;
	}
	function retirer_historique($historique){
		$aux="";
		for ($i=0; $i<sizeof($historique); $i=$i+3){
			if ($i==0){
				$aux .= " where";
			}
			if($historique[$i+1]=='true' or $historique[$i+1]=='false'){
				$aux .= " req.col<>'{$historique[$i]}'";
			}
			else{
				$aux .= " req.attrb<>'{$historique[$i+1]}'";
			}
			if ($i+3<sizeof($historique)){
				$aux .= " and";
			}
		}
		return $aux;
	}
	function colonnes_attributs($tables){
		$tabSimple = $tables->getTabSimple();
		$req="";
		for ($i=0; $i<sizeof($tabSimple); $i++){
			$StringCol = $tabSimple[$i];
			$req .= "select '{$StringCol}' as col, cast({$StringCol} as text) as attrb from {$this->table} group by {$StringCol}";
			if ($i!=sizeof($tabSimple)-1){
				$req .= " UNION ";
			}
		}	
		return $this->colonnes_attributs_second($req, $tables);
				
	}
	function colonnes_attributs_second($req, $Tables){	
		$tabComplexe = $Tables->getTabComplexe();
		$taille = sizeof($tabComplexe);
		if ($req!=""){
			$req.= " UNION ";		
		}
		
		for ($i=0; $i<sizeof($tabComplexe)-1; $i=$i+2){
			$tab_objet = $tabComplexe[$i];
			$tab_liaison = $tabComplexe[$i+1];
			$req .= "select '{$tab_objet}' as col , cast({$tab_objet} as text) as attrb from {$tab_objet} group by {$tab_objet}";
			if ($i!=$taille-2){
				$req .= " UNION ";
			}
		}
		return $req;
	}
	function chercher_erreur($tables, $histo, $pays){
		$tab = $histo;
		for ($i=0; $i<sizeof($tab); $i=$i+3){
			$reponse_fausse=false;
			$col = $tab[$i];
			$rep = $tab[$i+1];
			if ($tab[$i+2]==true){ $comp='=';}
			else{ $comp='<>'; }
			$bool= $tables->appartient_a_table_simple($col);
	
			if ($bool==true){
				$req = "select count(*) from {$this->table} where nom='{$pays}' and {$col}{$comp}'{$rep}'";
				$res = query($req);
				$row = fetch($res);
				if ($row[0]=='0'){
					$reponse_fausse=true;
				}
			}else{
				if ($tab[$i+2]==true){ $comp='in';}
				else{ $comp='not in'; }
				$tab_objet=$tables->get_tab_objet($col);
				$tab_liaison=$tables->get_tab_liaison($col);
				

				if($tab[$i+2]==true){
					$req_test = "select count(*) from (select * from {$this->table} p, {$tab_liaison} y, {$tab_objet} x where p.nom='{$pays}' and p.id=y.id_{$this->table} and id_{$tab_objet}=x.id and x.{$tab_objet}='{$rep}') as t;";
					$res_test = query($req_test);
					$row_test = fetch($res_test);
					if ($row_test[0]=='0'){
						$reponse_fausse=true;
					}
				}
				else{
					$avant_retranchement = "select count(*) from {$this->table} p, {$tab_liaison} y where p.nom='{$pays}' and p.id=y.id_{$this->table};";
					$apres_retranchement = "select count(*) from {$this->table} p, {$tab_liaison} y where p.nom='{$pays}' and p.id=y.id_{$this->table} and id_{$tab_objet} {$comp} (select id from {$tab_objet} where {$col}='{$rep}');";
					$res_avant = query($avant_retranchement); $res_apres = query($apres_retranchement);
					$row_avant = fetch($res_avant); $row_apres = fetch($res_apres);
					if ($row_avant[0]!=$row_apres[0]){ $reponse_fausse=true; }

				}
			}
			if ($reponse_fausse==true){
					$erreur[] = $tab[$i];
					$erreur[] = $tab[$i+1];
					$erreur[] = $tab[$i+2];
			}
		}
	$str="";
	for ($i=0; $i<sizeof($erreur); $i=$i+3){
			$oui = $this->donne_erreur($tables, $erreur[$i],$erreur[$i+1],$erreur[$i+2],$pays,$this->table);
			$oui = replace($oui);
			$str .= $oui . '<br/>';
	}
	return $str;
	}
	

	function donne_erreur($tables, $col, $rep, $bool, $pays, $table){
		$test= $tables->appartient_a_table_simple($col);
		$bonne_rep="";
		if ($test==true){
			$req = "select {$col} from pays where nom='{$pays}'";
			$res = query($req);
			$row = fetch($res);
			$bonne_rep = $row[0];
		}else{
			$tab_objet = $tables->get_tab_objet($col);
			$tab_liaison = $tables->get_tab_liaison($col);
			$req = "select {$col} from {$table} p, {$tab_objet} x, {$tab_liaison} y where p.nom='{$pays}' and p.id=y.id_{$table} and x.id=y.id_{$tab_objet};";
			$res = query($req);
			while($row = fetch($res)){
				$bonne_rep .= $row[0] . ", ";
			}
		}
		if ($bool==true){ $vrai="vrai"; }
		else{ $vrai="faux"; }

		if($test==false){ $res = "<p> Votre réponse a la question {$col}={$rep} -> {$vrai}, les bonnes réponses: {$bonne_rep} pour le pays: {$pays}</p>"; }
		else{ $res = "<p> Votre réponse a la question {$col}={$rep} -> {$vrai}, la bonne réponse: {$bonne_rep} pour le pays: {$pays}</p>"; }
		return $res;
	}
	function pays_appartient($pays){
		$res = query("select count(*) from {$this->table} where nom='{$pays}';");
		$row = fetch($res);
		if ($row[0]>0){ return true; }
		return false;
	}
}

?>