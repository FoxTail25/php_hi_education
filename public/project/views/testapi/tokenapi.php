<?php
$token = '12345';
if(isset($_GET['token']) and $_GET['token'] == $token){
	if(isset($_GET['dateBirth'])){
		echo getAnswer($_GET['dateBirth']);
	} else {
		echo 'Дата рождения отсутствует';
	}
} else {
	echo 'Ошибочный токен';
}
function getAnswer($birthDate){
	if($birthDate > date('Y-m-d')){
		$res = "В этом году, ";
		$res.= "через ".getDayDiff($_GET['dateBirth'])." дней.";
	} else {
		$res = "В следующем году ";
		$res .="через ".getDayDiff($_GET['dateBirth'], true)." дней.";
	}	
	echo $res;
}
function getDayDiff($date, $nextYear = false){
	$now = date_create('now');
	$birthDate = date_create($date);
	if($nextYear){
		$nextYearNow = date_create($date);
		date_modify($nextYearNow, '+1 year');
		return date_diff($birthDate, $nextYearNow)->format('%a') - date_diff($birthDate, $now)->format('%a');;
	}
	return date_diff($birthDate, $now)->format('%a');
}
?>