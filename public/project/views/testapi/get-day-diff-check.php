<?php
if(isset($_GET['date-start']) && isset($_GET['date-finish'])){
	if(chekedInkomingDate($_GET['date-start']) && chekedInkomingDate($_GET['date-finish'])){
		echo getDateDiff($_GET['date-start'], $_GET['date-finish']);
	} else {
		echo 'некоректная дата';
	}
} else {
	echo 'error';
}
function getDateDiff($dateStr1, $dateStr2){
	$date1 = date_create($dateStr1);
	$date2 = date_create($dateStr2);
	$dateDiff = date_diff($date1, $date2);
	return $dateDiff->format('%a дней');
}
function chekedInkomingDate($str){
	$str = explode('-', $str);
	return checkdate($str[1], $str[2], $str[0]);
}
?>