<h4>Преобразование данных в JSON в PHP</h4>
<p>
	С помощью функции json_encode можно автоматически преобразовывать данные в PHP формате в формат JSON. Давайте посмотрим на примере. Пусть у нас есть следующий массив:
</p>
<code>
	<pre>
		&lsaquo;?php
			$data = [1, 2, 3];
		?&rsaquo;
	</pre>
</code>
<p>
	Преобразуем его в JSON;
</p>
<code>
	<pre>
		&lsaquo;?php
			$json = json_encode($data);
		?&rsaquo;
	</pre>
</code>
<p>
	Проверим что получилось:
</p>
<code>
	<pre>
		&lsaquo;?php
			$data = [1, 2, 3];
			$json = json_encode($data);
			var_dump($json); // выведет: <?=var_dump(json_encode([1, 2, 3]))?>
		?&rsaquo;
	</pre>
</code>

<div class="navigate_arrow">
	<a href="/json/0_intro/">Назад</a>
	<a href="/json/2_json_in_data/">Вперёд</a>
</div>
