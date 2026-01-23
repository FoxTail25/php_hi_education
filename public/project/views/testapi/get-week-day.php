<?php
	// проверяем наличие GET-запроса
	if (isset($_GET['year-month-day'])) {
		echo getWeekDay($_GET['year-month-day']);
	} else {
		echo 'error';
	}
	// обрабатываем запрос и отправляем ответ
	function getWeekDay($dateString){
		$dateArr = explode('-', $dateString);
		$timestemp = mktime(0,0, $dateArr[1], $dateArr[0], $dateArr[2]);
		return 'Сегодня ' .date('l', $timestemp).' - это '.normaliseDay(date('w', $timestemp)).' день недели' ;
	}
	// меняем нулевой день недели на 7й
	function normaliseDay($num){
		if($num == 0){
			return 7;
		}
		return $num;
	}
?>