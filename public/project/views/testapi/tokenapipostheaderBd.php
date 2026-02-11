<?php
use Project\Models\TokenWork;
$tokenWork = new TokenWork;

if(isset($_SERVER['HTTP_X_TOKEN']) and $tokenWork->checkToken($_SERVER['HTTP_X_TOKEN'])){
	if(isset($_POST['dateBirth'])){
		echo getAnswer($_POST['dateBirth']);
	} else {
		echo 'Дата рождения отсутствует';
	}
} else {
	echo 'Ошибочный токен';
}
function getAnswer($birthDate){
	if($birthDate > date('Y-m-d')){
		$res = "В этом году, ";
		$res.= "через ".getDayDiff($_POST['dateBirth'])." дней.";
	} else {
		$res = "В следующем году ";
		$res .="через ".getDayDiff($_POST['dateBirth'], true)." дней.";
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