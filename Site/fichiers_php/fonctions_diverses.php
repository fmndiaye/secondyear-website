<?php

	function replace($StringText) { // remplace _ par un espace
		$res ="";
		$i = 0;
		while ($i < strlen($StringText)) {
		      if ($StringText{$i} != "_") {
		      	 $res .= $StringText{$i};
		      }
		      else {
		      	   $res .= " ";
		      }
		      $i += 1;
		}
		return $res;
	}
	function double_apo($StringText) { // remplace _ par un espace
		$res ="";
		$i = 0;
		while ($i < strlen($StringText)) {
		      if ($StringText{$i} == "'") {
		      	 $res .= "''";
		      }
		      else {
		      	   $res .= $StringText{$i};
		      }
		      $i += 1;
		}
		return $res;
	}
	

?>