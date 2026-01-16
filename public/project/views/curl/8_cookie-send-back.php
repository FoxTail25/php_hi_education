<h4>Обратная отправка кук через CURL в PHP</h4>
<p>
	Сохраненные в файле куки можно автоматически отправлять назад при следующем запросе. Это делается с помощью двух опций: опция CURLOPT_COOKIEJAR командует принимать и сохранять куки в файл, а опция CURLOPT_COOKIEFILE командует отправлять сохраненные куки на сервер.
</p>
<p>
	Давайте установим эти опции:
</p>
<code>
	<pre>
	&lsaquo;?php
		$cookieFilePath = $_SERVER['DOCUMENT_ROOT'] . '/cookie.txt';
		
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookieFilePath);
		curl_setopt($curl, CURLOPT_COOKIEJAR,  $cookieFilePath);
	?>
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Сделайте два запроса на следующую страницу:
		</i>
	</p>
	<code>
		<pre>
			//test.loc/page-qookie-back.php
			&lsaquo;?php
				if (!empty($_COOKIE)) {
					echo date('H:i:s', $_COOKIE['time']);
				} else {
					setcookie('time', time(), time() + 3600, '/');
					echo 'cookie saved';
				}
			?>
		</pre>
	</code>

	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php

		?>		
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php

	?>		
</div>