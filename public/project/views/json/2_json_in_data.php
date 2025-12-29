<h4>Преобразование данных из JSON в PHP</h4>
<p>
	С помощью функции json_decode можно автоматически преобразовывать данные из формата JSON в PHP структуры. Давайте посмотрим на примере. Пусть у нас есть следующий JSON:
</p>
<code>
	<pre>
		&lsaquo;?php
			$json = '[1, 2, 3]';
		?&rsaquo;
	</pre>
</code>
<p>
	Преобразуем данные в PHP:
</p>
<code>
	<pre>
&lsaquo;?php
	$json = '[1, 2, 3]';
	$data = json_decode($json);
	print_r($data): 
<?=print_r(json_decode('[1, 2, 3]'));?>
?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Преобразуйте следующий JSON в структуру PHP:
		</i>
	</p>
	<code>
		<pre>
			&lsaquo;?php
				$json = '["x","y","z"]';
			?&rsaquo;
		</pre>
	</code>
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$json = '["x","y","z"]';
				$data = json_decode($json);
				print_r($data);
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$json = '["x","y","z"]';
			$data = json_decode($json);
			print_r($data);
		?>
</div>

<div class="navigate_arrow">
	<a href="/json/1_data_in_json/">Назад</a>
	<a href="/json/3_objects-to-data/">Вперёд</a>
</div>