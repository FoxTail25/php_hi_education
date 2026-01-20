<h4>Отправка куки на сервер через CURL в PHP</h4>
<p>
	Средствами CURL можно отправлять куки, создавая для целевого сайта ощущение, что кука отправлена настоящим браузером. Это делается с помощью опции CURLOPT_COOKIE.
</p>
<p>
	Давайте для примера установим куку с именем 'name' и значением 'john':
</p>

<code>
	<pre>
		&lsaquo;?php
			curl_setopt($curl, CURLOPT_COOKIE, 'name=john');
		?>
	</pre>
</code>

<p>
	Несколько кук разделяются точкой с запятой с последующим пробелом:
</p>

<code>
	<pre>
		&lsaquo;?php
			curl_setopt($curl, CURLOPT_COOKIE, 'name=john; login=admin');
		?>
	</pre>
</code>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Отправьте запрос на следующую страницу и получите результат:
		</i>
	</p>
	<code>
		<pre>
			// https://phphi.local/testloc/page-cookie.php
			&lsaquo;?php
				if (!empty($_COOKIE)) {
					echo json_encode($_COOKIE);
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
			$link = 'https://phphi.local/testloc/page-cookie/';
			$cookie_d = 'name=john; login=admin';

			function curlCookie($link, $cookieData = false) {
				
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $link);
				if($cookieData){
					curl_setopt($curl, CURLOPT_COOKIE, $cookieData);
				}
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				
				return curl_exec($curl);	
			}
			echo curlCookie($link, $cookie_d);
		?>		
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
		$link = 'https://phphi.local/testloc/page-cookie/';
		$cookie_d = 'name=john; login=admin';

		function curlCookie($link, $cookieData = false) {
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			if($cookieData){
				curl_setopt($curl, CURLOPT_COOKIE, $cookieData);
			}
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			return curl_exec($curl);	
		}
		echo curlCookie($link, $cookie_d);
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
			// http://phphi.local/testloc/page-qookie-num.php
			&lsaquo;?php
				if (!empty($_COOKIE)) {
					echo $_COOKIE['num1'] + $_COOKIE['num2'];
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
			$link = 'https://phphi.local/testloc/page-cookie-num/';
			$cookie_d = 'num1=2; num2=5';

			function curlCookie($link, $cookieData = false) {
				
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $link);
				if($cookieData){
					curl_setopt($curl, CURLOPT_COOKIE, $cookieData);
				}
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				
				return curl_exec($curl);	
			}
			echo curlCookie($link, $cookie_d);
		?>		
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
		$link = 'https://phphi.local/testloc/page-cookie-num/';
		$cookie_d = 'num1=2; num2=5';


		echo curlCookie($link, $cookie_d);
	?>		
</div>
<div class="navigate_arrow">
	<a href="/curl/6_data-method-post/">Назад</a>
	<a href="/curl/8_cookie-send-back/">Вперёд</a>
</div>
