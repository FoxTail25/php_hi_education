<h4>Обработка некорректности JSON в PHP</h4>
<p>
	Бывает такое, что строка с JSON построена некорректно. В этом случае функция json_decode вернет null. Давайте попробуем на практике. Сделаем некорректный JSON (определите сами, что с ним не так):
</p>
<code>
	<pre>
	&lsaquo;?php
		$json = '["a", "b", "c",]';
	?&rsaquo;
	</pre>
</code>
<p>
	Попробуем разобрать этот JSON:
</p>
<code>
	<pre>
	&lsaquo;?php
		$data = json_decode($json);
		var_dump($data); // выведет null
	?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Дана строка с некоторым JSON. Разберите его в структуру данных PHP. Выведите результат разбора или ошибку, если разобрать JSON не удалось.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
			$json = '["a", "b", "c",]';
			$answer = '';
			$data = json_decode($json);

			if(!is_null($data)) {
				$answer = 'correct json';
			} else {
				$answer = 'incorrect json';
			}
			echo $answer;
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$json = '["a", "b", "c",]';
			$answer = '';
			$data = json_decode($json);

			if(!is_null($data)) {
				$answer = 'correct json';
			} else {
				$answer = 'incorrect json';
			}
			echo $answer;
		?>
</div>
<div class="navigate_arrow">
	<a href="/json/5_data-sending/">Назад</a>
	<a href="/json/7_json_parser_error/">Вперёд</a>
</div>