<h4>Внешние переменные стрелочной функции в PHP</h4>
<p>
	В стрелочной функции внешние переменные доступны автоматически. Но только в том случае, если они объявлены ДО самой функции!
</p>
<code>
	<pre>
		&lsaquo;?php
			$num1 = 1;
			$num2 = 2;
			
			$func = fn() => $num1 + $num2;
			
			echo $func(); // 3
		?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Перепишите следующий код через стрелочную функцию:
		</i>
	</p>
	<code>
		<pre>
			&lsaquo;?php
				$num1 = 1;
				$num2 = 2;
				
				$func = function() use ($num1, $num2)
				{
					echo $num1 + $num2;
				};
				
				$func();
			?&rsaquo;
		</pre>
	</code>

	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$num1 = 1;
				$num2 = 2;

				$func = fn() => $num1 + $num2;
				echo $func();
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$num1 = 1;
			$num2 = 2;

			$func = fn() => $num1 + $num2;
			echo $func();
		?>
</div>
<div class="navigate_arrow">
	<a href="/function/7_arrow_func/">Назад</a>
	<a href="/function/9_func_calling_by_name/">Вперёд</a>
</div>