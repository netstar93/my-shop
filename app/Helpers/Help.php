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