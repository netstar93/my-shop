<?php
/**
 * Created by PhpStorm.
 * User: Nitish
 * Date: 02 Oct
 * Time: 02:20 AM
 */

function _log($data, $exit=1){
    echo "<pre>"; print_r($data);
    if($exit ==1) die;
}

function renderBoolean($val,$type = null) {
	switch($type){
		case 'question' :
			return $val == 1 ? 'Yes' : 'No';
		default:	
			return $val == 1 ? 'Enable' : 'Disable';
	}
}

function renderPrice($val,$round = false) {
	if($round) return "Rs.".round($val); 
	else return "Rs.".$val;
}