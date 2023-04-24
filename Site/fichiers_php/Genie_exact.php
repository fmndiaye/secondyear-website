<?php
	require_once("fonctions_diverses.php");
	require_once('interaction_bdd_exact.php');
	require_once('Tables.php');
	require_once('ConnectBDD.php');
	connectbase();

	
	
	
class Genie_exact {

	private $interact;
	private $pseudo;
	private $tables;


	private $table;
	private $StringCol;
	private $attrb;
	

	private $historique;
	
	public $question;
	public $reponse;

	function __construct($table, $id_debutSimple, $pseudo, $tableau){
		$this->tables = new Tables($table, $id_debutSimple, $tableau);
		$this->interact = new BDD_exact($table, $pseudo);
		$this->table=$table;
		$this->pseudo=$pseudo;
	}
	function getQuestion(){
		if ($this->question==null or $this->question==""){ echo "question null ??"; }
		else{ echo $this->question; }
	}
	function fini(){
		$aux = $this->interact->compter_restants();
		if ($aux==1){	
			$res = $this->interact->reponse();
			$this->reponse = $res;
			return true; 
		}
		return false;
	}
	function poser(){ //change la question donnée sur la page html
		$req = $this->interact->requeteSimple($this->tables, $this->table);
	
		$tab =$this->interact->genererQuestion($this->tables, $req, $this->historique);
		$this->attrb = $tab[0];
		$this->StringCol = $tab[2];
		$questionGenere="";
		$aux = replace($this->StringCol);
		$attrb_aux = $this->attrb;
		if ($this->attrb=="true" or $this->attrb=="false"){
			$attrb_aux="";
			$this->attrb="true";
		}
		$pref = $this->interact->get_prefixe($this->StringCol, $attrb_aux);

		$this->question = $pref;
		return $pref;
	}
	function pays_appartient($pays){
		return $this->interact->pays_appartient($pays);
	}
	function reponse($bool){
		$this->interact->reduire($this->tables, $bool, $this->StringCol, $this->attrb);
		$this->historique[] = $this->StringCol;
		$this->historique[] = $this->attrb;
		$this->historique[] = $bool;
	}
	function afficher_pays($pays){
		echo $this->interact->chercher_erreur($this->tables, $this->historique, $pays);
	}

}

?>