<h4>API с POST параметрами в PHP</h4>
<p>
	Параметры API можно передавать не только методом GET, но и методом POST. Давайте посмотрим, как это делается. Пусть наше API ожидает данные через метод POST:
</p>
<code>
	<pre>
&lsaquo;?php
	echo mt_rand($_POST['num1'], $_POST['num2']);
?>	
	</pre>
</code>
<p>
	Давайте сделаем запрос на это API. Для этого нам понадобится библиотека CURL. Сделаем POST запрос с ее помощью:
</p>
<code>
	<pre>
&lsaquo;?php
	$url = 'http://api.loc/index.php';
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	
	$data = ['num1'=>'1', 'num2'=>'100'];
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
			Сделайте API, которое POST данными будет принимать знак зодиака и дату, а отдавать гороскоп для этого знака на заданную дату.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Пишем API в файле post_param.php
	</p>
	<code>
		<pre>
&lsaquo;?php
	if(isset($_POST['zodiak']) && isset($_POST['date'])){
		$zodiak = $_POST['zodiak'];
		$date = $_POST['date'];
		echo "$zodiak $date";

	} else {
		echo 'отсутствует POST запрос';
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
	$url = "http://phphi.local/testapi/post_param";

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	
	$data = ['zodiak'=>'leo', 'date'=>'21.01.2026'];
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	
	$res = curl_exec($curl);
	
	echo $res;
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php
		$url = "http://phphi.local/testapi/post_param";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		
		$data = ['zodiak'=>'leo', 'date'=>'21.01.2026'];
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		
		$res = curl_exec($curl);
		
		echo $res;
	?>		
</div>
<div class="navigate_arrow">
	<a href="/api/6_json/">Назад</a>
	<a href="/api/8/">Вперёд</a>
</div>