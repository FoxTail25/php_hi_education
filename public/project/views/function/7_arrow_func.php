<h4>Стрелочные функции в PHP</h4>
<p>
	Далее конспектируется изучение стрелочных функций. Они предствлят собой сокращенный вариант анонимных функций. Выглядит это так:
</p>
<code>
	<pre>
		&lsaquo;?php
			fn (параметры) => выражение;
		?&rsaquo;
	</pre>
</code>
<p>
	Ниже предствлено 2 идентичных функции. Одна обычная, вторая стрелочная.
</p>
<code>
	<pre>
		&lsaquo;?php
		// обычная запись функции

		$func = function($num1, $num2) {
			return $num1 + $num2;
		};
		
		echo $func(1, 2);
		?&rsaquo;

		&lsaquo;?php
		// стрелочная запись функции

		$func = fn($num1, $num2) => $num1 + $num2;
		echo $func(1, 2);
		?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Перепишите следующую функцию в стрелочную:
		</i>
	</p>
	<code>
		<pre>
			&lsaquo;?php
				$greet = function($name)
				{
					return 'hello ' . $name;
				};
				
				echo $greet('fred');
			?&rsaquo;
		</pre>
	</code>

	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$greet = fn($name) => 'hello ' . $name;
				echo $greet('fred');
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$greet = fn($name) => 'hello ' . $name;
			echo $greet('fred');
		?>
</div>
<div class="navigate_arrow">
	<a href="/function/6_anonim_return_type/">Назад</a>
	<a href="/function/8_outer_var_arrow/">Вперёд</a>
</div>