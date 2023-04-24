<?php
	require_once('ConnectBDD.php');
	require_once('Tables.php');
	require_once('fonctions_diverses.php');
	connectbase();

class BDD_exact{
	//liste des attributs que nous avons besoin pour communiquer avec la base
	private $tables;
	private $table;
	private $pseudo;
	private $req_reponse;

	function __construct($table, $pseudo){
		$this->table=$table;
		$this->pseudo=$pseudo;
		$this->req_reponse="select * from {$table} where id is not null ";
	}
	function compter_restants(){
		$req = "select count(*) from ({$this->req_reponse}) as t";
		$res = query($req);
		$row = fetch($res);
		return (integer)$row[0];
	}
	function reponse(){
		$req = "select * from ({$this->req_reponse}) as t";
		$res = query($req);
		$row = fetch($res);
		return $row[1];
	}
	function requeteSimple($tables, $table){
		$req="";
		$tab = $tables->getTabSimple();
		for ($i=0; $i<sizeof($tab); $i++){
			$StringCol = $tab[$i];
			$req .= "
			select CAST(t.attrib as text), 
			ABS(((select count(*) from ({$this->req_reponse}) as TableRep)::float/2::float)-t.nb_occur::float) as ecart
			,('{$StringCol}') as col 
			from (select {$StringCol} as attrib, count(id) as nb_occur from ({$this->req_reponse}) as TableOccur group by {$StringCol}) as t ";
			if ($i!=sizeof($tab)-1){
				$req .= " UNION ";
			}
		}
		return $this->requeteComplexe($tables, $table, $req);		
	}
	function requeteComplexe($tables, $table, $req){
		$tabComplexe = $tables->getTabComplexe();
		$taille = sizeof($tabComplexe);
		if ($req!=""){
			$req.= " UNION ";		
		}
		for ($i=0; $i<sizeof($tabComplexe)-1; $i=$i+2){
			$tab_objet = $tabComplexe[$i];
			$tab_liaison = $tabComplexe[$i+1];
			$getCol = query("select column_name as colonnes from information_schema.columns where table_name='{$tab_objet}';");
			while($row = fetch($getCol)){ $StringCol = $row[0]; }
			$req .= "select  CAST(cx.{$StringCol} as text),
			 ABS(((select count(*) from ({$this->req_reponse}) as p)::float/2::float)-t.nb_occur::float) as ecart,
			  ('{$StringCol}') as col 
			  from (select id_{$tab_objet} as attrib, 
			  	count(distinct id_{$table}) as nb_occur 
			  	from {$tab_liaison} where id_{$table} in (select id from ({$this->req_reponse}) as test1) 
			  	and id_{$tab_objet} in (select id from (select * from {$tab_objet}) as test2) group by id_{$tab_objet} order by id_{$tab_objet}) as t, 
				{$tab_objet} cx where t.attrib=cx.id ";
			if ($i!=$taille-2){
				$req .= " UNION ";
			}
		}
		$req .= " order by ecart";
		return $req;
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
	function genererQuestion($tables, $req, $historique){
		$aux = $this->retirer_historique($historique);
		$req = "select * from ({$req}) as req";
		$req .= $aux;
		$res = query($req);
		$row = fetch($res);
		return $row;
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
				$aux .= " req.attrib<>'{$historique[$i+1]}'";
			}
			if ($i+3<sizeof($historique)){
				$aux .= " and";
			}
		}
		return $aux;
	}
	function get_prefixe($StringCol, $attrb_aux){
		$res = query("select prefixe from prefixe p, questions_prefixes where id=id_prefixe and colonne='{$StringCol}';");
		$row = fetch($res);
		$questionGenere = $row[0] . ' ' . $attrb_aux;
		return $questionGenere;
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
	function reduire($tables, $bool, $StringCol, $attrb){
		$aux = $tables->appartient_a_table_simple($StringCol);
		if ($aux==true){
			if ($bool==true){ $comp = "="; }
			else{ $comp = "<>"; }
			$suite_req = " and {$StringCol}{$comp}'{$attrb}'";
		}
		else{
			if ($bool==true){ $comp = "in"; }
			else{ $comp = "not in"; }
			$tab_liaison = $tables->get_tab_liaison($StringCol);
			$tab_objet = $tables->get_tab_objet($StringCol);
			$suite_req = " and id {$comp} (select x.id_{$this->table} from {$tab_liaison} x, {$tab_objet} y where y.{$StringCol}='{$attrb}' and y.id=x.id_{$tab_objet}) ";
		}
		$this->req_reponse .= $suite_req;
		// return $this->req_reponse;
	}

}

?>