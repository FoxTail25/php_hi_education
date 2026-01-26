<h4>API с несколькими GET параметрами в PHP</h4>
<p>
	Пусть теперь у нас будет передаваться не один параметр, а несколько. Например, два числа:
</p>
<code>
	<pre>
	http://api.loc/index.php?num1=1&num2=100
	</pre>
</code>
<p>
	Давайте в ответ вернем случайное число в диапазоне от первого переданного числа до второго:
</p>
<code>
	<pre>
&lsaquo;?php
	if (isset($_GET['num1']) and isset($_GET['num2'])) {
		echo mt_rand($_GET['num1'], $_GET['num2']);
	} else {
		echo 'error';
	}
?>	
	</pre>
</code>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Сделайте API с адресом, на который двумя параметрами будут передаваться даты в формате год-месяц-день, а в ответ будет отдаваться количество дней между этими датами.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Пишем API в файле get-day-diff.php
	</p>
	<code>
		<pre>
&lsaquo;?php
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
	}
?>	
		</pre>
	</code>	
	<p>
		Отправляем запрос к созданному API c этой страницы:
	</p>
	<code>
		<pre>
&lsaquo;?php
	$dateStart = date('Y-m-d', mktime(0,0,0, 01,20,2026));
	$dateFinish = date('Y-m-d');
	echo file_get_contents("http://phphi.local/testapi/get-day-diff?date-start=$dateStart&date-finish=$dateFinish");
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
<?php
	$dateStart = date('Y-m-d', mktime(0,0,0, 01,20,2026));
	$dateFinish = date('Y-m-d');
	echo file_get_contents("http://phphi.local/testapi/get-day-diff?date-start=$dateStart&date-finish=$dateFinish");
?>		
</div>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Модифицируйте предыдущую задачу так, чтобы выполнялась проверка на корректность формата даты.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Пишем API в файле get-day-diff.php
	</p>
	<code>
		<pre>
&lsaquo;?php
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
		</pre>
	</code>	
	<p>
		Отправляем запрос к созданному API c этой страницы:
	</p>
	<code>
		<pre>
&lsaquo;?php
	$dateStart = '2026-01-31';
	$dateFinish = date('Y-m-d');
	echo file_get_contents("http://phphi.local/testapi/get-day-diff-check?date-start=$dateStart&date-finish=$dateFinish");
		echo '&lsaquo;br/>';
	$dateStart = '2026-01-32';
	$dateFinish = date('Y-m-d');
	echo file_get_contents("http://phphi.local/testapi/get-day-diff-check?date-start=$dateStart&date-finish=$dateFinish");
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
<?php
	$dateStart = '2026-01-31';
	$dateFinish = date('Y-m-d');
	echo file_get_contents("http://phphi.local/testapi/get-day-diff-check?date-start=$dateStart&date-finish=$dateFinish");
	echo '<br/>';
	$dateStart = '2026-01-32';
	$dateFinish = date('Y-m-d');
	echo file_get_contents("http://phphi.local/testapi/get-day-diff-check?date-start=$dateStart&date-finish=$dateFinish");
?>		
</div>

<div class="navigate_arrow">
	<a href="/api/4_get-parameter/">Назад</a>
	<a href="/api/6_json/">Вперёд</a>
</div>