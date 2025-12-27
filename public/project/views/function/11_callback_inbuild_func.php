<h4>Коллбэки во встроенных функциях в PHP</h4>
<p>
	В PHP есть ряд встроенных функций, которые параметром принимают коллбэки. Общий принцип работы с ними мы изучим на примере функции array_map. Данная функция первым параметром принимает коллбэк, а вторым - массив. Функция применяет коллбэк к каждому элементу массива и возвращает измененный массив.
</p>
<p>
	Давайте посмотрим на варианты использования этой функции с учетом полученных нами ранее знаний.
</p>
<h5>
	Вариант 1
</h5>
<p>
	Извлечем из каждого элемента массива квадратный корень с помощью встроенной функции sqrt. Для этого в качестве коллбэка параметром передадим строку с именем этой функции:
</p>
<code>
	<pre>
		&lsaquo;?php
			$arr = [1, 2, 3, 4, 5];
			
			$res = array_map('sqrt', $arr);
			var_dump($res);
		?&rsaquo;
	</pre>
</code>
<h5>
	Вариант 2
</h5>
<p>
	Возведем каждый элемент массива в квадрат с помощью созданной нами обычной функции. Для этого в качестве коллбэка параметром передадим строку с именем этой функции:
</p>
<code>
	<pre>
		&lsaquo;?php
			$arr = [1, 2, 3, 4, 5];
			
			function func($num) {
				return $num ** 2;
			}

			$res = array_map('func', $arr);
			var_dump($res);
		?&rsaquo;
	</pre>
</code>
<h5>
	Вариант 3
</h5>
<p>
	Переделаем нашу функцию на анонимную, записанную в переменную:
</p>
<code>
	<pre>
		&lsaquo;?php
			$arr = [1, 2, 3, 4, 5];
			
			$func = function ($num) {
				return $num ** 2;
			};

			$res = array_map($func, $arr);
			var_dump($res);
		?&rsaquo;
	</pre>
</code>
<h5>
	Вариант 4
</h5>
<p>
	Передадим анонимную функцию параметром:
</p>
<code>
	<pre>
		&lsaquo;?php
			$arr = [1, 2, 3, 4, 5];
			
			$res = array_map(function ($num) {
				return $num ** 2;
			}, $arr);
			
			var_dump($res);
		?&rsaquo;
	</pre>
</code>
<h5>
	Вариант 5
</h5>
<p>
	Используем стрелочную функцию:
</p>
<code>
	<pre>
		&lsaquo;?php
			$arr = [1, 2, 3, 4, 5];
			
			$res = array_map(fn ($num) => $num ** 2, $arr);
			var_dump($res);
		?&rsaquo;
	</pre>
</code>
<h5>
	Вариант 6
</h5>
<p>
	Пусть теперь степень, в которую нужно возвести число, задается внешней переменной коллбэка. Воспользуемся этой переменной, получив к ней доступ через use:
</p>
<code>
	<pre>
		&lsaquo;?php
			$arr = [1, 2, 3, 4, 5];
			$pow = 3;
			
			$res = array_map(function ($num) use ($pow) {
				return $num ** $pow;
			}, $arr);
			
			var_dump($res);
		?&rsaquo;
	</pre>
</code>
<h5>
	Вариант 7
</h5>
<p>
	Перепишем предыдущий код через стрелочную функцию. Теперь переменная $pow будет доступна автоматически:
</p>
<code>
	<pre>
		&lsaquo;?php
			$arr = [1, 2, 3, 4, 5];
			$pow = 3;
			
			$res = array_map(fn ($num) => $num ** $pow, $arr);
			var_dump($res);
		?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Дан массив со строками. Переведите текст каждого элемента массива в верхний регистр.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$strArr = ['a','b','c'];
				$resultArr = array_map(fn($str)=>strtoupper($str));
				print_r($resultArr);
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$strArr = ['a','b','c'];
			$resultArr = array_map(fn($str)=>strtoupper($str), $strArr);
			print_r($resultArr);
		?>
</div>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Дан массив со строками. Переверните текст каждого элемента массива так, чтобы символы шли в обратном порядке.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$strArr = ['abc','bca','cab'];
				$resultArr = array_map(fn($str)=>strrev($str), $strArr);
				print_r($resultArr);
			?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
			$strArr = ['abc','bca','cab'];
			$resultArr = array_map(fn($str)=>strrev($str), $strArr);
			print_r($resultArr);
		?>
</div>
<div class="navigate_arrow">
	<a href="/function/10_callbask/">Назад</a>
	<a href="/json/0_intro/">Вперёд</a>
</div>