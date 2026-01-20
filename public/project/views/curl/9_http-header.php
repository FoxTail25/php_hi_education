<h4>Установка HTTP заголовков через CURL в PHP</h4>
<p>
	С помощью опции CURLOPT_HTTPHEADER можно при запросе отправлять HTTP заголовки запроса. В качестве параметра эта опция принимает массив заголовков и их значений.
</p>
<p>
	Давайте установим эту опцию, передав некоторые заголовки:
</p>
<code>
	<pre>
	&lsaquo;?php
		$headers = [
			'Accept-Language: en-US',
			'Accept: text/html'
		];
		
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	?>		
	</pre>
</code>
<p>
	На странице, на которую отправляем запрос, можно проверить, что указанные заголовки отправились:
</p>
<code>
	<pre>
	&lsaquo;?php
		echo ($_SERVER['HTTP_ACCEPT_LANGUAGE']).'&lsaquo;br/>'.($_SERVER['HTTP_ACCEPT']);
	?>		
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Отправьте запрос на следующую страницу, указав заголовок X-Test:
		</i>
	</p>
	<code>
		<pre>
			// https://phphi.local/testloc/page-http-header.php
			&lsaquo;?php
				echo $_SERVER['HTTP_X_TEST'];
			?>
		</pre>
	</code>

	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$link = 'https://phphi.local/testloc/page-http-header/';
			$headers = [
				'x-test: success!' // ВАЖНО!! Отправляем заголовок "x-test", в запросе он будет: "X_TEST"!!!!
			];
			
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			echo curl_exec($curl);
		?>		
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
			$link = 'http://phphi.local/testloc/page-http-header/';
			$headers = [
				'x-test: success!'
			];
				
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			echo curl_exec($curl);
	?>		
</div>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Отправьте запрос на следующую страницу и получите результат:
		</i>
	</p>
	<code>
		<pre>
			// https://phphi.local/testloc/page-http-header-check/
			&lsaquo;?php
				if ($_SERVER['HTTP_X_TEST'] === '12345') {
					echo 'result';
				} else {
					echo 'error';
				}
			?>
		</pre>
	</code>

	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$link = 'http://phphi.local/testloc/page-http-header-check/';

			$headers_true = [
				'x-test: 12345'
			];
			$headers_false = [
				'x-test: 123'
			];
		
			function curkHeader($link, $headers){

				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $link);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				
				return curl_exec($curl);
			}

			echo curkHeader($link, $headers_true);
			echo '&lsaquo;br/>';
			echo curkHeader($link, $headers_false);
		?>		
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
		$link = 'http://phphi.local/testloc/page-http-header-check/';
		$headers_true = [
			'x-test: 12345'
		];
		$headers_false = [
			'x-test: 123'
		];
	
		function curkHeader($link, $headers){

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			return curl_exec($curl);
		}

		echo curkHeader($link, $headers_true);
		echo '<br/>';
		echo curkHeader($link, $headers_false);
	?>		
</div>