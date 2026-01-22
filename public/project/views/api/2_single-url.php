<h4>API с одним URL в PHP</h4>
<p>
	Давайте для разминки сделаем API с одним адресом, на который можно обращаться. Пусть этот адрес будет следующим:
</p>
<code>
	<pre>
&lsaquo;?php
	http://api.loc/index.php
?>
	</pre>
</code>
<p>
	Давайте для примера наш API будет по обращению к адресу отдавать случайное число от 1 до 100:
</p>
<code>
	<pre>
&lsaquo;?php
	echo mt_rand(1, 100);
?>
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Сделайте API, которое будет возвращать текущее время в формате часы-минуты-секунды.
		</i>
	</p>


	<h4>Решение:</h4>

	<code>
		<pre>

/*
Создаю страницу с API file: project/views/testapi/timetest.php
*/
	&lsaquo;?php
	echo date('H-i-s');
	?>

// теперь с этой сраницы, к созданному api, можно обратиться вот так:
&lsaquo;?php
	$url = 'http://phphi.local/testapi/timetest/';
	$res = file_get_contents($url);

	echo $res;

	// либо можно сделать так: 
	// echo file_get_contents('http://phphi.local/testapi/timetest/');
?>		
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
	// $url = 'http://phphi.local/testapi/timetest/';
	// $res = file_get_contents($url);

	// echo $res;
	echo file_get_contents('http://phphi.local/testapi/timetest/');
	?>		
</div>