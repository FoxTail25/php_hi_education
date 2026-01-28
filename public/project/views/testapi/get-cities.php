<?php
use \Project\Models\Cities;

if(isset($_GET['country_id'])){
	$country_id = $_GET['country_id'];
	echo jsonCitiesArr($country_id);
} else {
	echo 'страна не указана';
}
function jsonCitiesArr($id){

	$cities = new Cities;
	$res = $cities->getCities($id);
	return json_encode($res);
	}
?>