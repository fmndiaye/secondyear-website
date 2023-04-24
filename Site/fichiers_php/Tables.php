<?php

require_once('ConnectBDD.php');
require_once('interaction_bdd.php');
connectbase();


class Tables{
	private $tabSimple;
	private $tabComplexe;

	function __construct($table, $id_tabSimple, $tableau){
		$this->init_tableSimple($table, $id_tabSimple);
		$this->add_tableComplexe($tableau);
	}
	function init_tableSimple($table, $id_tabSimple) {		
		$i=0;
		$tab = BDD::colonnes($table);
		for($i=$id_tabSimple; $i<sizeof($tab); $i++){
			$this->tabSimple[]=$tab[$i];
		}
	}
	function add_tableComplexe($tableau){ 
		for ($i=0; $i+1<sizeof($tableau); $i=$i+2){
			
			$this->tabComplexe[] = $tableau[$i];
			$this->tabComplexe[] = $tableau[$i+1];
		}
	}
	function getTabComplexe(){ 
		return $this->tabComplexe; 
	}
	function getTabSimple(){ 
		return $this->tabSimple; 
	}

	function appartient_a_table_simple($StringCol){
		for ($i=0; $i<sizeof($this->tabSimple); $i++){
			if ($StringCol==$this->tabSimple[$i]){ return true; }
		}
		return false;
	}
	
	function get_tab_objet($StringCol){
		for($i=0; $i<sizeof($this->tabComplexe); $i=$i+2){
			$table = $this->tabComplexe[$i];
			$tab = BDD::colonnes($table);
			$aux = $tab[1];
			if ($aux==$StringCol){ 
				return $this->tabComplexe[$i];
			}
		}
	}

	function get_tab_liaison($StringCol){
		for($i=0; $i<sizeof($this->tabComplexe); $i=$i+2){
				$table = $this->tabComplexe[$i];
				$tab = BDD::colonnes($table);
				$aux = $tab[1];
				if ($aux==$StringCol){ 
					return $this->tabComplexe[$i+1];
				}
			}
	}
}


?>