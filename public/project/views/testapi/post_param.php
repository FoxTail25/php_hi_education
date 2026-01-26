<?php
	if(isset($_POST['zodiak']) && isset($_POST['date'])){
		$zodiak = $_POST['zodiak'];
		$date = $_POST['date'];
		echo "$zodiak $date";

	} else {
		echo 'отсутствует POST запрос';
	}
?>