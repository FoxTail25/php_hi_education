<h4>Ответ CURL в переменную в PHP</h4>
<p>
	Следующая настройка заставляет ответ сервера сохранять в переменную, а не выводить на страницу браузера:
</p>
<code>
	<pre>
		&lsaquo;?php
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		?>
	</pre>
</code>
<p>
	Давайте исправим код в соответствии с этой настройкой:
</p>
<code>
	<pre>
		&lsaquo;?php
			// Адрес страницы для обращения:
			$url = 'http://test.loc';
			
			// Инициализируем сеанс:
			$curl = curl_init();
			
			// Указываем адрес страницы:
			curl_setopt($curl, CURLOPT_URL, $url);
			
			// Ответ сервера сохранять в переменную:
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			// Выполняем запрос, сохранив ответ в переменную:
			$res = curl_exec($curl);
			
			// Смотрим, что в переменной:
			var_dump($res);
		?>
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Оберните приведенный код в функцию. Пусть эта функция параметром принимает URL, а возвращает полученный результат.
		</i>
	</p>
	
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php

			function siteToVar($link){
				$link = 'https://'.$link;
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $link);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$res = curl_exec($curl);

				return $res;
			}
			$siteLink = 'test.loc';
			var_dump(siteToVar($siteLink));
		?>	
			
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php

		function siteToVar($link){
			$link = 'https://'.$link;
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$res = curl_exec($curl);

			return $res;
		}
		$siteLink = 'test.loc';
		var_dump(siteToVar($siteLink));
	?>		
</div>
<div class="navigate_arrow">
	<a href="/curl/0_intro/">Назад</a>
	<a href="/curl/2_err-check/">Вперёд</a>
</div>
