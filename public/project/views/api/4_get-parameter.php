<h4>API с GET параметром в PHP</h4>
<p>
	Давайте теперь сделаем API, которому при обращении будет передаваться параметр и ответ будет отдаваться в зависимости от этого параметра.
</p>
<p>
	Для примера пусть параметром передается некоторое целое число:
</p>
<code>
	<pre>
	http://api.loc/index.php?num=100
	</pre>
</code>
<p>
	Давайте в ответ вернем случайное число в диапазоне от единицы до переданного числа:
</p>
<code>
	<pre>
&lsaquo;?php
	if (isset($_GET['num'])) {
		echo mt_rand(1, $_GET['num']);
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
			Сделайте API с адресом, на который параметром будет передаваться дата в формате год-месяц-день, а в ответ будет отдаваться день недели, соответствующий этой дате.
		</i>
	</p>


	<h4>Решение:</h4>
	<p>
		Первое что необходимо сделать. Это немного поправить код сайта, что бы он корректно обрабатывал адрес с GET запросам. Для этого добавим в файл core/Router.php, в функцию getTrack() следующее условие:
	</p>
	<code>
		<pre>
&lsaquo;?php
	if(str_contains($uri,'?')){ 
		/*
		проверяем адресную строку на наличии "?" т.е. GET-запроса.
		(так же проверку можно делать по $_SERVER['QUERY_STRING'])
		Если он есть, то отрезаем его. 
		Теперь роутер будет корректно работать с GET-запросами
		*/
		$uri = stristr($uri, '?', true);
	}
?>	
		</pre>
	</code>
	<p>
		Пишем API в файле get-week-day.php
	</p>
		<code>
		<pre>
&lsaquo;?php
	// проверяем наличие GET-запроса
	if (isset($_GET['year-month-day'])) {
		echo getWeekDay($_GET['year-month-day']);
	} else {
		echo 'error';
	}
	// обрабатываем запрос и отправляем ответ
	function getWeekDay($dateString){
		$dateArr = explode('-', $dateString);
		$tm = mktime(0,0,0, $dateArr[1], $dateArr[2], $dateArr[0]);
		return 'Сегодня '.date('d-m-Y', $tm).' - это '.date('l', $tm).' '.normaliseDay(date('w', $tm)).'й день недели' ;
	}
	}
	function normaliseDay($num){
	// меняем нулевой день недели на 7й
		if($num == 0){
			return 7;
		}
		return $num;
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
	$dateStr = date('Y-m-d');

	echo file_get_contents("http://phphi.local/testapi/get-week-day?year-month-day=$dateStr");
	
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php
	$dateStr = date('Y-m-d');

	echo file_get_contents("http://phphi.local/testapi/get-week-day?year-month-day=$dateStr");
	?>		
</div>
<div class="navigate_arrow">
	<a href="/api/3_multi-url/">Назад</a>
	<a href="/api/5_multi-get-parameters/">Вперёд</a>
</div>