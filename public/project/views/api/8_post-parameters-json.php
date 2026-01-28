<h4>API с POST параметрами в формате JSON в PHP</h4>
<p>
	Бывает так, что параметры представляют собой массивы. В этом случае такие параметры следует паковать в JSON. Давайте посмотрим на примере. Пусть у нас есть следующее API, ожидающее массив в формате JSON и возвращающее сумму элементов этого массива:
</p>
<code>
	<pre>
		// file: api.loc
&lsaquo;?php
	echo array_sum(json_decode($_POST['json'], true));
?>	
	</pre>
</code>
<p>
	Давайте сделаем запрос на это API:
</p>
<code>
	<pre>
&lsaquo;?php
	$url = 'http://api.loc/index.php';
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	
	$arr  = [1, 2, 3, 4, 5];
	$json = json_encode($arr);
	$data = ['json' => $json];
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	
	$res = curl_exec($curl);
	
	var_dump($res);
?>	
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Сделайте API, которое параметром будет принимать массив чисел, а возвращать их сумму.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Пишем API в файле api_post_summ.php
	</p>
	<code>
		<pre>
&lsaquo;?php
if(isset($_GET['jsonArr'])){
	$arrNum = json_decode($_GET['jsonArr']);
	echo array_sum($arrNum);
} else {
	echo 'пост параметр "jsonArr" пуст';
}
?>	
		</pre>
	</code>	
	<p>
		Отправляем запрос к созданному API c этой страницы, декодируем ответ и выводим результат на экран:
	</p>
	<code>
		<pre>
&lsaquo;?php
	$url = "http://phphi.local/testapi/api_post_summ";

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	$json = json_encode([1,2,3,4,5]);
	$data = ['jsonArr'=> $json];
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	
	$res = curl_exec($curl);
	
	echo $res;
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php
	$url = "http://phphi.local/testapi/api_post_summ";

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	$json = json_encode([1,2,3,4,5]);
	$data = ['jsonArr'=> $json];
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	
	$res = curl_exec($curl);
	
	echo $res;
	?>		
</div>

<div class="navigate_arrow">
	<a href="/api/6_json/">Назад</a>
	<a href="/api/9_database-api/">Вперёд</a>
</div>