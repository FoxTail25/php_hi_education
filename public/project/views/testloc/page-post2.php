<?php

	if (!empty($_POST)) {
		echo $_POST['num1'] + $_POST['num2'];
	} else {
		echo 'error';
	}
?>