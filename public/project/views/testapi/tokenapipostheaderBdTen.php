<?php
use Project\Models\TokenWork;
$tokenWork = new TokenWork;

if(isset($_SERVER['HTTP_X_TOKEN']) and $tokenWork->checkToken($_SERVER['HTTP_X_TOKEN'])){
	if(isset($_POST['dateBirth'])){
		$ceckQueryCount = checkCount();
		if($ceckQueryCount['pass']){
			echo getAnswer($_POST['dateBirth']).' '.$ceckQueryCount['msg'];
		} else {
			echo $ceckQueryCount['msg'];
		};
	} else {
		echo 'Дата рождения отсутствует';
	}
} else {
	echo 'Ошибочный токен';
}
// функция формирования ответа API
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
// функция вычисления дней между датами
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
// функция проверки и изменения счёт запроса с токена.
function checkCount() {
	$token = $_SERVER['HTTP_X_TOKEN'];
	$tokenWork = new TokenWork;
	$tokenId = $tokenWork->checkToken($token)['id'];
	$checkToken = $tokenWork->checkCount($tokenId);
	if(is_null($checkToken)) {

		$tokenWork->addTokenCount($tokenId);
		return ['pass' => true, 'tokenId'=>$tokenId, 'tokenCount'=> 1, 'msg'=>"первый вход" ];

	} else {
		
		$count = $checkToken['count'];
		$dateInDb = $checkToken['querydate'];
		$dateNow = date('Y-m-d');
		
		if($dateInDb != $dateNow) {

			$tokenWork->updateTokenCount($tokenId, 1, $dateNow);
			return ['pass' => true, 'tokenId'=>$tokenId, 'tokenCount'=> 1, 'msg'=>"смена даты" ];

		} else if ($dateInDb == $dateNow and $count < 10) {
			
			$count += 1;
			$tokenWork->updateTokenCount($tokenId, $count, $dateNow);
			return ['pass' => true, 'tokenId'=>$tokenId, 'tokenCount'=> $count , 'msg'=>"$count запрос за сегодня."];
		
		} else {
			return ['pass' => false, 'tokenId'=>$tokenId, 'tokenCount'=> $count, 'msg'=>'10 попыток использовано'];
		}
	}
}
?>