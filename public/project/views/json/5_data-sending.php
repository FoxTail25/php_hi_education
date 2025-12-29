<h4>Отправка данных в формате JSON в PHP</h4>
<p>
	При работе сайта часто бывает так, что некоторые URL отдают не HTML код, а JSON. Давайте напишем пример такой страницы:
</p>
<code>
	<pre>
	&lsaquo;?php
		$data = [1, 2, 3];
		$json = json_encode($data);
		echo $json;
	?&rsaquo;
	</pre>
</code>
<p>
	Более правильным будет отдать при этом соответствующий HTTP заголовок:
</p>
<code>
	<pre>
	&lsaquo;?php
		$data = [1, 2, 3];
		$json = json_encode($data);
		
		header('Content-Type: application/json');
		echo $json;
	?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			По обращению к некоторому файлу создайте массив с числами от 1 до 100 и отдайте его в формате JSON.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$arr = range(1,100,1);

				$jsonArr = json_encode($arr);
				header('Content-Type: application/json');
				echo $json;			
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$arr = range(1,100,1);

			$jsonArr = json_encode($arr);
			// header('Content-Type: application/json');
			echo "<p style='overflow:scroll;'>$jsonArr</p>";
		?>
</div>
<div class="navigate_arrow">
	<a href="/json/4_objects-to-arrays/">Назад</a>
	<a href="/json/6_incorrect_json/">Вперёд</a>
</div>