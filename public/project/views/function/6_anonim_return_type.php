<h4>Тип возвращаемого значения анонимной функции в PHP</h4>
<p>
	Чтобы указать тип значения, возвращаемого анонимной функцией, нужно объявить его его после конструкции use:
</p>
	<code>
		<pre>
			&lsaquo;?php
				$num = 2;
				
				$func = function() use ($num): string
				{
					return $num ** 2;
				};
				
				echo $func();
			?&rsaquo;
		</pre>
	</code>


<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Укажите тип возвращаемого значения:
		</i>
	</p>
	<code>
		<pre>
			&lsaquo;?php
				$num1 = 4;
				$num2 = 3;
				
				$res = function() use ($num1, $num2)
				{
					return pow($num1, $num2);
				};
					
				echo $res();
			?&rsaquo;
		</pre>
	</code>
	<h4>Решение:</h4>
		<code>
		<pre>
			&lsaquo;?php
				$num1 = 4;
				$num2 = 3;
				
				$res = function() use ($num1, $num2): int
				{
					return pow($num1, $num2);
				};
					
				$answer = $res();
				echo gettype($answer).": ". $answer; 
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
		$num1 = 4;
		$num2 = 3;
		
		$res = function() use ($num1, $num2): int
		{
			return pow($num1, $num2);
		};
			
		$answer = $res();
		echo gettype($answer).": ". $answer; 
	?>
</div>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Укажите тип возвращаемого значения:
		</i>
	</p>
	<code>
		<pre>
			&lsaquo;?php
				$age = 18;
				
				$func = function($name ) use ($age)
				{
					return 'name: ' . $name . ' age: ' . $age;
				};
					
				echo $func('alex');
			?&rsaquo;
		</pre>
	</code>
	<h4>Решение:</h4>
		<code>
		<pre>
			&lsaquo;?php
				$age = 18;
				
				$func = function($name ) use ($age): string
				{
					return 'name: ' . $name . ' age: ' . $age;
				};
					
				$answer = $func('alex');
				echo gettype($answer).": ". $answer; 
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
		$age = 18;
		
		$func = function($name ) use ($age): string
		{
			return 'name: ' . $name . ' age: ' . $age;
		};
			
			
		$answer = $func('alex');
		echo gettype($answer).": ". $answer; 
	?>
</div>
<div class="navigate_arrow">
	<a href="/function/5_var_befor_call_anonim/">Назад</a>
	<a href="/function/7_arrow_func">Вперёд</a>
</div>