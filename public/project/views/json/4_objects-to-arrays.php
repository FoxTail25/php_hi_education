<h4>Объекты из JSON в ассоциативные массивы в PHP</h4>
<p>
	Можно сделать так, чтобы объекты JSON преобразовывались в ассоциативные массивы в PHP. Для этого нужно второй параметр функции json_decode установить в значение true.
</p>
<p>
	Давайте попробуем. Пусть у нас есть следующий JSON:
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
<p>Преобразуем его в ассоциативный массив PHP:</p>
<code>
	<pre>
		&lsaquo;?php
		$json = '{
			"a": 1,
			"b": 2,
			"c": 3
		}';
		$data = json_decode($json, true);
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
		$data = json_decode($json, true);
		var_dump($data);///
		?&rsaquo;
	</pre>
</code>
<?=var_dump(json_decode('{"a":1,"b":2,"c":3}',true));?>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Преобразуйте следующий JSON в ассоциативный массив PHP::
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
			$data = json_decode($json, true);
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
			$data = json_decode($json, true);
			var_dump($data);
		?>
</div>
<div class="navigate_arrow">
	<a href="/json/3_objects-to-data/">Назад</a>
	<a href="/json/5_data-sending/">Вперёд</a>
</div>