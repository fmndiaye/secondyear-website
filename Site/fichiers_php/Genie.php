<?php
	require_once("fonctions_diverses.php");
	require_once('interaction_bdd.php');
	require_once('Tables.php');
	require_once('ConnectBDD.php');
	connectbase();

	
	
	
class Genie {

	private $interact;
	private $pseudo;
	private $tables;


	private $table;
	private $StringCol;
	private $attrb;
	

	private $historique;
	
	public $question;
	public $reponse;
	

	function __construct($table, $id_debutSimple, $pseudo, $tableau, $seuil){
		$this->tables = new Tables($table, $id_debutSimple, $tableau);
		$this->interact = new BDD($table, $pseudo, $seuil);

		$this->table=$table;
		$this->pseudo=$pseudo;

		query("insert into match(pseudo, id_table, poids) (select '{$pseudo}', id,1 from {$table})");
		
	}
	function getQuestion(){
		if ($this->question==null or $this->question==""){
			echo "question null ??";
		}
		else{
			echo $this->question;
		}
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
		$req = $this->interact->colonnes_attributs($this->tables);
	
		$tab =$this->interact->genererQuestion($this->tables, $req, $this->historique);
		
		$this->attrb = $tab[1];
		$this->StringCol = $tab[0];
		$questionGenere="";
		$aux = replace($this->StringCol);
		$attrb_aux = $this->attrb;
		if ($this->attrb=="true" or $this->attrb=="false"){
			$attrb_aux="";
			$this->attrb="true";
		}
		$pref = $this->interact->get_prefixe($this->StringCol, $attrb_aux);

		$this->question = $pref;
	}
		
	
	function reponse($bool){	
		$this->historique[] = $this->StringCol;
		$this->historique[] = $this->attrb;
		$this->historique[] = $bool;
		$this->interact->reduire_poids($this->tables, $this->StringCol, $this->attrb, $bool);
	}
	function pays_appartient($pays){
		return $this->interact->appartient_table($pays);
	}
	function afficher_pays($pays){
		$str = $this->interact->chercher_erreur($this->tables, $this->historique, $pays);
		echo $str;
	}
}

?>
