<?php
if(isset($_GET['date-start']) && isset($_GET['date-finish'])){
	echo getDateDiff($_GET['date-start'], $_GET['date-finish']);
} else {
	echo 'error';
}
function getDateDiff($dateStr1, $dateStr2){
	$date1 = date_create($dateStr1);
	$date2 = date_create($dateStr2);
	$dateDiff = date_diff($date1, $date2);
	return $dateDiff->format('%a дней');
	// return $dateStr1.' '. $dateStr2;
}
?>