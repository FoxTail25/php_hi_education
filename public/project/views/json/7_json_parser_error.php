<h4>Ошибки парсера при разборе JSON в PHP</h4>
<p>
	С помощью функции json_last_error можно узнать, какая именно ошибка случилась при парсинге JSON. Давайте посмотрим, как это делается. Пусть у нас есть некорректный JSON:
</p>
<code>
	<pre>
	&lsaquo;?php
		$json = '["a", "b", "c",]';
	?&rsaquo;
	</pre>
</code>
<p>
	Давайте попробуем разобрать его:
</p>
<code>
	<pre>
	&lsaquo;?php
	$data = json_decode($json);
	var_dump($data); // выведет null
	?&rsaquo;
	</pre>
</code>
<p>
	Так как возникала ошибка, то json_last_error при вызове выдаст номер этой ошибки:
</p>
<code>
	<pre>
	&lsaquo;?php
	$error = json_last_error();
	var_dump($error); // номер ошибки
	?&rsaquo;
	</pre>
</code>
<p>
	Возвращаемый номер можно сравнивать со специальными константами PHP. На основе этого можно написать код, отлавливающий различные типы ошибок:
</p>
<code>
	<pre>
	&lsaquo;?php
	 switch (json_last_error()) {
		case JSON_ERROR_NONE:
			echo 'ошибок нет';
		break;
		case JSON_ERROR_DEPTH:
			echo 'достигнута максимальная глубина стека';
		break;
		case JSON_ERROR_STATE_MISMATCH:
			echo 'некорректные разряды или несоответствие режимов';
		break;
		case JSON_ERROR_CTRL_CHAR:
			echo 'некорректный управляющий символ';
		break;
		case JSON_ERROR_SYNTAX:
			echo 'синтаксическая ошибка, некорректный JSON';
		break;
		case JSON_ERROR_UTF8:
			echo 'некорректные символы UTF-8, возможно неверно закодирован';
		break;
		default:
			echo 'неизвестная ошибка';
		break;
	}
	?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Дана строка с некоторым JSON. Разберите его в структуру данных PHP. Выведите результат разбора или причину ошибки, если разобрать JSON не удалось.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
			$json = '[1,2,3,]';

			function getDataOrErrFromJSON($json){
				$answer ='';
				$data = json_decode($json);
				if(!is_null($data)){
					$answer = $data;
				} else {
					switch (json_last_error()) {
						case JSON_ERROR_NONE:
							$answer 'ошибок нет';
						break;
						case JSON_ERROR_DEPTH:
							$answer 'достигнута максимальная глубина стека';
						break;
						case JSON_ERROR_STATE_MISMATCH:
							$answer 'некорректные разряды или несоответствие режимов';
						break;
						case JSON_ERROR_CTRL_CHAR:
							$answer 'некорректный управляющий символ';
						break;
						case JSON_ERROR_SYNTAX:
							$answer 'синтаксическая ошибка, некорректный JSON';
						break;
						case JSON_ERROR_UTF8:
							$answer 'некорректные символы UTF-8, возможно неверно закодирован';
						break;
						default:
							$answer 'неизвестная ошибка';
						break;
					}
				}
				return $answer;
			}
			print_r(getDataOrErrFromJSON($json));
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$json = '[1,2,3,]';

			function getDataOrErrFromJSON($json){
				$answer ='';
				$data = json_decode($json);
				if(!is_null($data)){
					$answer = $data;
				} else {
					switch (json_last_error()) {
						case JSON_ERROR_NONE:
							$answer = 'ошибок нет';
						break;
						case JSON_ERROR_DEPTH:
							$answer = 'достигнута максимальная глубина стека';
						break;
						case JSON_ERROR_STATE_MISMATCH:
							$answer = 'некорректные разряды или несоответствие режимов';
						break;
						case JSON_ERROR_CTRL_CHAR:
							$answer = 'некорректный управляющий символ';
						break;
						case JSON_ERROR_SYNTAX:
							$answer = 'синтаксическая ошибка, некорректный JSON';
						break;
						case JSON_ERROR_UTF8:
							$answer = 'некорректные символы UTF-8, возможно неверно закодирован';
						break;
						default:
							$answer = 'неизвестная ошибка';
						break;
					}
				}
				return $answer;
			}
			print_r(getDataOrErrFromJSON($json));
		?>
</div>
<div class="navigate_arrow">
	<a href="/json/6_incorrect_json/">Назад</a>
	<a href="/json/8/">Вперёд</a>
</div>