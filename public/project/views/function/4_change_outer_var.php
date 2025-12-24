<h4>Изменение внешних переменных анонимных функций в PHP</h4>
<p>
	Внешние переменные, измененные внутри анонимной функции, не изменятся снаружи:
</p>
<code>
	<pre>
		&lsaquo;?php
			$num = 1;
			
			$func = function() use ($num)
			{
				$num = 2;
			};
			
			$func();
			echo $num; // 1
		?&rsaquo;
	</pre>
</code>
<p>
	Для того, чтобы изменения применились, нужно передать переменную по ссылке:
</p>
<code>
	<pre>
		&lsaquo;?php
			$num = 1;
			
			$func = function() use (&$num)
			{
				$num = 2;
			};
			
			$func();
			echo $num; // 2
		?&rsaquo;
	</pre>
</code>
<h3>Задача</h3>
<p>
	<i>
		Исправьте код, чтобы он заработал задуманным образом:
	</i>
</p>
<code>
	<pre>
		&lsaquo;?php
			$num1 = 2;
			$num2 = 3;
			
			$func = function() use ($num1, $num2)
			{
				$num1 = $num1 ** 2;
				$num2 = $num2 ** 2;
			};
			
			$func();
			echo $num1;
			echo $num2;
		?&rsaquo;
	</pre>
</code>
<div class="task">
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
		$num1 = 2;
		$num2 = 3;
		
		$func = function() use (&$num1, &$num2)
		{
			$num1 = $num1 ** 2;
			$num2 = $num2 ** 2;
		};
		
		$func();
		echo $num1;
		echo $num2;
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$num1 = 2;
			$num2 = 3;
			
			$func = function() use (&$num1, &$num2)
			{
				$num1 = $num1 ** 2;
				$num2 = $num2 ** 2;
			};
			
			$func();
			echo $num1;
			echo $num2;
		?>
</div>
<div class="navigate_arrow">
	<a href="/function/3_anonim_func_get_outer_var/">Назад</a>
	<a href="/function/5_var_befor_call_anonim/">Вперёд</a>
</div>