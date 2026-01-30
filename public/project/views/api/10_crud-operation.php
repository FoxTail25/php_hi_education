<h4>API для CRUD операций в PHP</h4>
<p>
	Часто API создается для CRUD операций. Давайте распишем пример такого API.
</p>

<h5>Read всех</h5>
<p>
	Пусть следующий URL возвращает все записи из БД:
</p>
<code>
	<pre>
&lsaquo;?php
	GET http://phphi.local/testapi/crud-api?action=all
?>	
	</pre>
</code>
<h5>Read одной</h5>
<p>
	Пусть следующий URL возвращает одну запись из БД по ее id:
</p>
<code>
	<pre>
&lsaquo;?php
	GET http://phphi.local/testapi/crud-api?action=get&id=1
?>	
	</pre>
</code>
<h5>Delete</h5>
<p>
	Пусть следующий URL удаляет одну запись из БД по ее id:
</p>
<code>
	<pre>
&lsaquo;?php
	GET http://phphi.local/testapi/crud-api?action=del&id=1
?>	
	</pre>
</code>
<h5>Update</h5>
<p>
	Пусть следующий URL принимает новые данные записи из БД через метод POST и изменяет эту запись по ее id:
</p>
<code>
	<pre>
&lsaquo;?php
	POST http://phphi.local/testapi/crud-api?action=edit&id=1
?>	
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Реализуйте описанный API.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Пишем API в файле crudapi.php
	</p>
	<code>
		<pre>
&lsaquo;?php

?>	
		</pre>
	</code>	
	<p>
		Отправляем запрос к созданному API c этой страницы, декодируем ответ и выводим результат на экран:
	</p>
	<code>
		<pre>
&lsaquo;?php

?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php
	echo '<h5>Все города в базе данных</h5>';
	$url = "http://phphi.local/testapi/crudapi?action=all";
	$res = file_get_contents($url);
	foreach(json_decode($res,true) as $city){
		echo "$city[id] $city[name]<br/>";
	}

	echo '<br/><br/>';
	echo '<h5>Город с id = 1</h5>';
	$url = "http://phphi.local/testapi/crudapi?action=get&id=1";
	$res = json_decode(file_get_contents($url), true);
	echo "$res[id] $res[name]";

	echo '<br/><br/>';
	echo '<h5>Добавляем город TestCity</h5>';
	$url = "http://phphi.local/testapi/crudapi";
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	$json = json_encode(['name'=>'TestCity', 'countryid'=>'1']);
	$data = ['action'=>'add', 'jsondata'=>$json];
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	$res = curl_exec($curl);
	echo $res;

	// $res = json_decode(file_get_contents($url), true);
	// echo "$res[id] $res[name]";
	
	echo '<br/><br/>';
	echo '<h5>Все города в базе данных</h5>';
	$url = "http://phphi.local/testapi/crudapi?action=all";
	$res = file_get_contents($url);
	foreach(json_decode($res,true) as $city){
		echo "$city[id] $city[name]<br/>";
	}
	?>		

</div>