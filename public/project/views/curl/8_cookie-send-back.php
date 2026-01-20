<h4>Обратная отправка кук через CURL в PHP</h4>
<p>
	Сохраненные в файле куки можно автоматически отправлять назад при следующем запросе. Это делается с помощью двух опций: опция CURLOPT_COOKIEJAR командует принимать и сохранять куки в файл, а опция CURLOPT_COOKIEFILE командует отправлять сохраненные куки на сервер.
</p>
<p>
	Давайте установим эти опции:
</p>
<code>
	<pre>
		// https://phphi.local/testloc/page-cookie-back.php
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
			// https://phphi.local/testloc/page-cookie-back
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
		$link = 'https://phphi.local/testloc/page-cookie-back';
		$cookieFilePath = $_SERVER['DOCUMENT_ROOT'] . '/cookie.txt';

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $link);

		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookieFilePath);
		curl_setopt($curl, CURLOPT_COOKIEJAR,  $cookieFilePath);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		echo curl_exec($curl);

	?>		
</div>
<div class="navigate_arrow">
	<a href="/curl/7_cookie-send/">Назад</a>
	<a href="/curl/9_http-header/">Вперёд</a>
</div>