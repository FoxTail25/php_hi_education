<h3 class="theme_header">Получение внешних переменных анонимных функций в PHP</h3>
<p>
	Можно сделать так, чтобы внешние переменные были доступны внутри анонимной функции. Для этого нужно эти переменные объявить с помощью конструкции use следующим образом:
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
<h3>Задача</h3>
<p>
	<i>
		Исправьте проблему в данном коде:
	</i>
</p>
<code>
	<pre>
		&lsaquo;?php
			$num = 5;
			
			$func = function()
			{
				return $num ** 2;
			};
			
			echo $func();
		?&rsaquo;
	</pre>
</code>
<h4>Решение:</h4>
<code>
	<pre>
		&lsaquo;?php
			$num = 5;
			
			$func = function() use ($num)
			{
				return $num ** 2;
			};
			
			echo $func();
		?&rsaquo;
	</pre>
</code>
<h4>Результат:</h4>
	<?php
		$num = 5;
		
		$func = function() use ($num)
		{
			return $num ** 2;
		};
		
		echo $func();
	?>
<div class="navigate_arrow">
	<a href="/function/2_external_var_anonim_func/">Назад</a>
	<a href="/function/4_change_outer_var/">Вперёд</a>
</div>