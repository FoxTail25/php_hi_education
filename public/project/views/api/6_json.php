<h4>API отдающее JSON в PHP</h4>
<p>
	В настоящее время при обмене данными сайты используют формат JSON. Давайте сделаем API, отдающее данные в этом формате.
</p>
<p>
	Пусть для примера наше API будет отдавать массив, заполненный целыми числами от одного параметра до второго:
</p>
<code>
	<pre>
&lsaquo;?php
	header('Content-Type: application/json'); // укажем MIME
	
	$arr = range($_GET['num1'], $_GET['num2']);
	echo json_encode($arr);
?>	
	</pre>
</code>
<p>
	Давайте воспользуемся нашим API:
</p>
<code>
	<pre>
&lsaquo;?php
	$url = 'http://api.loc/index.php?num1=1&num2=10';
	$res = file_get_contents($url);
	var_dump($res); // данные в формате JSON
?>	
	</pre>
</code>
<p>
	Преобразуем полученные данные из формата JSON в обычный массив:
</p>
<code>
	<pre>
&lsaquo;?php
	$url = 'http://api.loc/index.php?num1=1&num2=10';
	$res = file_get_contents($url);
	
	$arr = json_decode($res);
	var_dump($arr);
?>	
	</pre>
</code>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Сделайте API, которое будет возвращать массив дат праздников в текущем году.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Пишем API в файле holidays.php
	</p>
	<code>
		<pre>
&lsaquo;?php
	$holiday = [
		'01.01.2026' => 'новый год',
		'08.03.2026' => '8е марта',
		'01.05.2026' => '1е мая',
	];
	echo json_encode($holiday);
?>	
		</pre>
	</code>	
	<p>
		Отправляем запрос к созданному API c этой страницы, декодируем ответ и выводим результат на экран:
	</p>
	<code>
		<pre>
&lsaquo;?php
	$holiday = file_get_contents("http://phphi.local/testapi/holidays");
	$holiday = json_decode($holiday,true);
	foreach($holiday as $date => $name){
		echo $date. " $name&lsaquo;br/>";
	}
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
<?php
	$holiday = file_get_contents("http://phphi.local/testapi/holidays");
	$holiday = json_decode($holiday,true);
	foreach($holiday as $date => $name){
		echo $date. " $name<br/>";
	}
?>		
</div>

<div class="navigate_arrow">
	<a href="/api/5_multi-get-parameters/">Назад</a>
	<a href="/api/7_post-parameters/">Вперёд</a>
</div>
