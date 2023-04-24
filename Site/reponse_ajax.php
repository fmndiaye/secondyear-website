<?php
	require_once 'fichiers_php/Genie.php';
	require_once 'fichiers_php/Genie_exact.php';
	require_once 'fichiers_php/ConnectBDD.php';
	connectbase();

	if (!(isset($_SESSION))){ session_start(); }
	$obj=$_SESSION['obj'];

	extract($_POST);

	if ($reponse=='oui'){
		$obj->reponse(true);
	}
	else{
		$obj->reponse(false);
	}
	if($obj->fini()==true){
		echo 'ok';
	}
	else{
		$obj->poser();
		echo $obj->question;
	}
	
	$_SESSION['obj']=$obj;

?>