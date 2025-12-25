<h4>Функции-коллбэки в PHP</h4>
<p>
	<i><b>Коллбэком (callback)</b></i> называется функция, которая передается параметром в другую функцию.
</p>
<p>
	Давайте посмотрим на примере. Пусть у нас есть функция, которая первым параметром принимает число, а вторым параметром - коллбэк:
</p>
<code>
	<pre>
		&lsaquo;?php
			function func($num, $calb) {
				
			}
		?&rsaquo;
	</pre>
</code>
<p>
	Сделаем так, чтобы внутри функции наш коллбэк, был вызван для переданного числа:
</p>
<code>
	<pre>
		&lsaquo;?php
			function func($num, $calb) {
				echo $calb($num);
			}
		?&rsaquo;
	</pre>
</code>
<p>
	Теперь рассмотрим передачи коллбека ($calb), в нашу функцию ($func)
</p>
<h5>Вариант 1</h5>
<p>
	Наш коллбэк может быть обычной функцией:
</p>
<code>
	<pre>
		&lsaquo;?php
			function calb($num) {
				return $num ** 2;
			}
		?&rsaquo;
	</pre>
</code>
<p>
	В этом случае, в качестве коллбека, мы передадим имя нашей функции:
</p>
<code>
	<pre>
		&lsaquo;?php
			func(3, 'calb');
		?&rsaquo;
	</pre>
</code>
<p>
	Внутри функции func наш коллбэк будет вызван по имени.
</p>
<h5>Вариант 2</h5>
<p>
	Наш коллбэк может быть анонимной функцией, записанной в переменную:
</p>
<code>
	<pre>
		&lsaquo;?php
		$calb = function($num) {
			return $num ** 2;
		};
		?&rsaquo;
	</pre>
</code>
<p>
	В этом случае мы параметром передаем переменную с нашей функцией:
</p>
<code>
	<pre>
		&lsaquo;?php
			func(3, $calb);
		?&rsaquo;
	</pre>
</code>
<h5>Вариант 3</h5>
<p>
	Можно передать анонимную функцию сразу параметром:
</p>
<code>
	<pre>
		&lsaquo;?php
			func(3, function($num) {
				return $num ** 2;
			});
		?&rsaquo;
	</pre>
</code>
<h5>Вариант 4</h5>
<p>
	Можно сократить код, используя стрелочную функцию:
</p>
<code>
	<pre>
		&lsaquo;?php
			func(3, fn($num) => $num ** 2);
		?&rsaquo;
	</pre>
</code>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Дана функция, параметром принимающая массив и коллбэк, который применится к каждому элементу массива:
		</i>
	</p>
	<code>
		<pre>
			&lsaquo;?php
				function func($arr, $calb) {
					$res = [];
					
					foreach ($arr as $elem) {
						$res[] = $calb($elem);
					}
					
					return $res;
				}
			?&rsaquo;
		</pre>
	</code>
	<p>
		<i>
			Вызовите эту функцию, в качестве параметра передав массив с числами и коллбэк, возводящий переданное число в квадрат.
		</i>
	</p>

	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				function func($arr, $calb) {
					$res = [];
					
					foreach ($arr as $elem) {
						$res[] = $calb($elem);
					}
					
					return $res;
				}
				$callback = fn($num) => $num**2;
				$result = func([1,2,3,4,5], $callback);
				print_r($result);
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			function func($arr, $calb) {
				$res = [];
				
				foreach ($arr as $elem) {
					$res[] = $calb($elem);
				}
				
				return $res;
			}
			$callback = fn($num) => $num**2;
			$result = func([1,2,3,4,5], $callback);
			print_r($result);
		?>
</div>
<div class="navigate_arrow">
	<a href="/function/9_func_calling_by_name/">Назад</a>
	<a href="/function/11_callback_inbuild_func/">Вперёд</a>
</div>