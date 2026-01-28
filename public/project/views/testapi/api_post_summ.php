<?php
if(isset($_POST['jsonArr'])){
	$arrNum = json_decode($_POST['jsonArr']);
	echo array_sum($arrNum);
} else {
	echo 'пост параметр "jsonArr" пуст';
}
?>