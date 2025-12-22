<h3 class="theme_header">Внешние переменные анонимных функций в PHP</h3>
<p>
	Анонимные функции, так же как и именованные функции не видят переменные обявленные вне функции.
</p>
<code>
	<pre>
		&lsaquo;?php
			$num1 = 1;
			$num2 = 2;
			
			$func = function()
			{
				echo $num1 + $num2; // ошибка, переменные недоступны
			};
			
			$func();
		?&rsaquo;
	</pre>
</code>
<h3>Задача</h3>
<p>
	<i>
		Расскажите, каким будет результат выполнения кода:
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
<h4>Результат:</h4>
<p>Результатом будет ошибка, т.к. внешняя переменная будет недоступна внутри функции:</p>
<?php
	$num = 5;
	
	$func = function()
	{
		return $num ** 2;
	};
	
	echo $func();
?>
<div class="navigate_arrow">
	<a href="/function/anonim_func/">Назад</a>
	<a href="/function/anonim_func_get_outer_var/">Вперёд</a>
</div>