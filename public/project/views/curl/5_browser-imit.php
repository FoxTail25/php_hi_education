<h4>Имитация браузера через CURL в PHP</h4>
<p>
	Следующая команда заставляет CURL имитировать браузер, отправляя заголовок User-Agent:
</p>
<code>
	<pre>
	&lsaquo;?php
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');
	?>
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			При обращении к некоторому сайту выполните имитацию браузера.
		</i>
	</p>
	
	<h4>Решение:</h4>
	<code>
		<pre>
		// http://phphi.local/testloc/browser-imit.php
		&lsaquo;?php
		echo 'page3&lsaquo;br/>';
		echo $_SERVER['HTTP_USER_AGENT'];
		?>



		&lsaquo;?php
		function siteToVar($link){
			$link = 'https://'.$link;
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($curl, CURLOPT_USERAGENT, 'FoxTail curl test Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');

			$res = curl_exec($curl);
			if($res){
				return $res;
			}
			return curl_error($curl);
		}
		$siteLink = 'phphi.local/testloc/browser-imit/';
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
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($curl, CURLOPT_USERAGENT, 'FoxTail curl test Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');

			$res = curl_exec($curl);
			if($res){
				return $res;
			}
			return curl_error($curl);
		}
		$siteLink = 'phphi.local/testloc/browser-imit';
		var_dump(siteToVar($siteLink));
		?>		
</div>
<div class="navigate_arrow">
	<a href="/curl/4_https_enabl/">Назад</a>
	<a href="/curl/6_data-method-post/">Вперёд</a>
</div>
