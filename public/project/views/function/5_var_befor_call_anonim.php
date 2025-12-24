<h4>Переменная перед вызовом анонимной функции в PHP</h4>
<p>
	Пусть у нас есть следующий код:
</p>
<code>
	<pre>
		&lsaquo;?php
			$pow = 2;
			
			$func = function($num) use ($pow)
			{
				return $num ** $pow;
			};
			
			echo $func(4);
		?&rsaquo;
	</pre>
</code>
<p>
	Приведенный выше код работает, так как переменная $pow написана перед объявлением функции. Однако, если мы поставим объявление переменной перед вызовом функции, все перестанет работать:
</p>
<code>
	<pre>
		&lsaquo;?php
			$func = function($num) use ($pow)
			{
				return $num ** $pow;
			};
			
			$pow = 2;
			echo $func(4);
		?&rsaquo;
	</pre>
</code>
<p>
	Можно исправить проблему, если передать переменную по ссылке:
</p>
<code>
	<pre>
		&lsaquo;?php
			$func = function($num) use (&$pow)
			{
				return $num ** $pow;
			};
			
			$pow = 2;
			echo $func(4);
		?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Исправьте код, чтобы он заработал задуманным образом:
		</i>
	</p>
	<code>
		<pre>
			&lsaquo;?php
				$func = function() use ($num1, $num2)
				{
					return $num1 + $num2;
				};
				
				$num1 = 2;
				$num2 = 3;
				echo $func();
			?&rsaquo;
		</pre>
	</code>
	<h4>Решение:</h4>
		<code>
		<pre>
			&lsaquo;?php
				$func = function() use (&$num1, &$num2)
				{
					return $num1 + $num2;
				};
				
				$num1 = 2;
				$num2 = 3;
				echo $func();
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
	<p></p>
	<?php
		$func = function() use (&$num1, &$num2)
		{
			return $num1 + $num2;
		};
		
		$num1 = 2;
		$num2 = 3;
		echo $func();	
	?>
</div>
<div class="navigate_arrow">
	<a href="/function/4_change_outer_var/">Назад</a>
	<a href="/function/6/">Вперёд</a>
</div>