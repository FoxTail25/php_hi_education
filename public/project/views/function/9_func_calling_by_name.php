<h4>Вызов функции по имени в PHP</h4>
<p>
	Пусть у вас в переменной хранится строка с именем функции. С помощью такой переменной вы можете вызвать функцию, имя которой хранится в этой переменной.

</p>
<p>
	Давайте посмотрим на примере. Пусть у нас есть следующая функция:
</p>
<code>
	<pre>
		&lsaquo;?php
			function func($num)
			{
				echo $num ** 2;
			}
		?&rsaquo;
	</pre>
</code>
<p>
	Пусть у нас также есть переменная с именем этой функции:
</p>
<code>
	<pre>
		&lsaquo;?php
			$name = 'func';
		?&rsaquo;
	</pre>
</code>
<p>
	Давайте вызовем функцию по ее имени. Для этого напишем переменную, содержащую имя функции, и поставим после нее круглые скобки вызова:
</p>
<code>
	<pre>
		&lsaquo;?php
			$name(3); // 9
		?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Пусть в переменной хранится имя встроенной в PHP функции sqrt для нахождения квадратного корня:
		</i>
	</p>
	<code>
		<pre>
			&lsaquo;?php
				$name = 'sqrt';
			?&rsaquo;
		</pre>
	</code>

	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$name = 'sqrt';
				echo $name(25);
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$name = 'sqrt';
			echo $name(25);
		?>
</div>
<div class="navigate_arrow">
	<a href="/function/8_outer_var_arrow/">Назад</a>
	<a href="/function/10_callbask">Вперёд</a>
</div>