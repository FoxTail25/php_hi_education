<h3 class="theme_header">Анонимные функции в PHP</h3>
<p>
	Если функция не имеет своего имени, то такая функция называется <span>Анонимной</span>. Такие функции можно записывать в качестве значения переменных.
</p>
<p>
	выглядит это следующим образом:
</p>
<code>
	<pre>
		&lsaquo;?php
			$func = function()
			{
				return '!!!';
			};
		?&rsaquo;
	</pre>
</code>
<p>
	Что бы вызвать такую функцию, надо поставить круглые скобки после имени переменной:
</p>
<code>
	<pre>
		&lsaquo;?php
			$func()
		?&rsaquo;
	</pre>
</code>
<h3>Задача</h3>
<p>
	<i>
		Сделать аононимноу  функцию, которая параметром будет принимать 2 числа, а возвращать их сумму.
	</i>
</p>
<h4>Решение:</h4>
<code>
	<pre>
		&lsaquo;?php
			$func = function ($one, $two) {
				return $one + $two;
			}
			echo $func(2,3);
		?&rsaquo;
	</pre>
</code>
<h4>Результат:</h4>
<?php
	$func = function ($one, $two) {
		return $one + $two;
	};
	echo $func(2,3);
?>
<div>
	<a href="/function/">Назад</a>
	<a href="/function/external_var_anonim_func/">Вперёд</a>
</div>
