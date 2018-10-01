<?php
function _log($data,$terminate =  1)
{
	echo "<pre>"; print_r($data);
	if($terminate == 1) die;
}