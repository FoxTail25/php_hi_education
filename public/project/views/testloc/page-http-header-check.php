<?php
	if ($_SERVER['HTTP_X_TEST'] === '12345') {
		echo 'result';
	} else {
		echo 'error';
	}
?>