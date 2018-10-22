<?php
/**
 * Created by PhpStorm.
 * User: Nitish
 * Date: 02 Oct
 * Time: 02:20 AM
 */

const PRODUCT_BASE_URL = "catalog/product/view/";

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
	if($round) return '&#x20b9;'.round($val); 
	else return '&#x20b9;'.$val;
}

function pro_url($product) {
	return PRODUCT_BASE_URL.$product->id;
}