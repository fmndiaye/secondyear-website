<?php 

	function connectbase() {
		$connexion = pg_connect("host=localhost dbname=genie3 user=genie3 password=genie3");
		return $connexion;
	}
	function query($str){
		return pg_query($str);
	}
	function fetch($res){
		return pg_fetch_array($res);
	}
	function fetch_assoc($res){
		return pg_fetch_assoc($res);
	}


?>