<h4>Преобразование объектов из JSON в PHP</h4>
<p>
	При преобразовании объектов JSON есть нюансы. Дело в том, что они преобразуются не в ассоциативные массивы PHP, а в объекты PHP.
</p>
<p>
	Давайте посмотрим. Пусть у нас есть следующий JSON:
</p>
<code>
	<pre>
		&lsaquo;?php
			$json = '{
				"a": 1,
				"b": 2,
				"c": 3
			}';
		?&rsaquo;
	</pre>
</code>
<p>
	Преобразуем его в структуру данных PHP:
</p>
<code>
	<pre>
		&lsaquo;?php
			$json = '{
				"a": 1,
				"b": 2,
				"c": 3
			}';
			$data = json_decode($json);
		?&rsaquo;
	</pre>
</code>
<p>
	Проверим, что у нас получилось:
</p>
<code>
	<pre>
		&lsaquo;?php
			$json = '{
					"a": 1,
					"b": 2,
					"c": 3
				}';
			$data = json_decode($json);
			var_dump($data);
		?&rsaquo;
	</pre>
</code>
<?=var_dump(json_decode('{"a": 1,"b": 2,"c": 3}'))?>
<p>
	Чтобы вывести наши значения по ключам, нужно обратиться к свойствам получившегося объекта:
</p>
<code>
	<pre>
		&lsaquo;?php
		echo $data->a; // выведет 1
		echo $data->b; // выведет 2
		echo $data->c; // выведет 3
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
				$json = '{
					"user": {
						"name": "john",
						"surn": "smit"
					},
					"city": "London"
				}';
			?&rsaquo;
		</pre>
	</code>
	<p>
		<i>
		Выведите на экран имя, фамилию и город.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$json = '{
					"user": {
						"name": "john",
						"surn": "smit"
					},
					"city": "London"
				}';
				$data = json_decode($json);
				echo $data->user->name;
				echo '&lsaquo;br/&rsaquo;';
				echo $data->user->surn;
				echo '&lsaquo;br/&rsaquo;';
				echo $data->city;
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
				$json = '{
					"user": {
						"name": "john",
						"surn": "smit"
					},
					"city": "London"
				}';
				$data = json_decode($json);
				echo $data->user->name;
				echo '<br/>';
				echo $data->user->surn;
				echo '<br/>';
				echo $data->city;
		?>
</div>
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
			$json = '{
				"list1": ["value11", "value12", "value13"],
				"list2": ["value21", "value22", "value23"]
			}';
			?&rsaquo;
		</pre>
	</code>
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$json = '{
					"list1": ["value11", "value12", "value13"],
					"list2": ["value21", "value22", "value23"]
				}';
				$data = json_decode($json);
				var_dump($data);
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
				$json = '{
					"list1": ["value11", "value12", "value13"],
					"list2": ["value21", "value22", "value23"]
				}';
				$data = json_decode($json);
				var_dump($data);
		?>
</div>

<div class="navigate_arrow">
	<a href="/json/2_json_in_data/">Назад</a>
	<a href="/json/4_objects-to-arrays/">Вперёд</a>
</div>
