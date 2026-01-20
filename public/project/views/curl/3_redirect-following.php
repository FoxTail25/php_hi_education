<h4>Переход по редиректам в CURL в PHP</h4>
<p>
	Следующая команда заставляет CURL переходить по HTTP редиректам:
</p>
<code>
	<pre>
	&lsaquo;?php
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	?>	
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Даны две страницы:
		</i>
	</p>
	<code>
		<pre>
			// http://phphi.local/testloc/redirect-out.php
		&lsaquo;?php
			header('Location: http://phphi.local/testloc/redirect-in/');
			die();
		?>	
			// http://phphi.local/testloc/redirect-in.php
		&lsaquo;?php
			echo 'is it redirect-in page';
		?>		
		</pre>
	</code>
	<p>
		Обратитесь через CURL к первой странице. Убедитесь, что он проследует по редиректу при наличии соответствующей настройки.
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
		function siteToVar($link){
			$link = 'https://'.$link;
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$res = curl_exec($curl);
			if($res){
				return $res;
			}
			return curl_error($curl);
		}
		$siteLink = 'phphi.local/testloc/redirect-out.php';
		var_dump(siteToVar($siteLink));
		?>			
		</pre>
	</code>
	
	<h4>Результат:</h4>
	<?php

		function siteToVar($link){
			$link = 'http://'.$link;
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$res = curl_exec($curl);
			if($res){
				return $res;
			}
			return curl_error($curl);
		}
		$siteLink = 'phphi.local/testloc/redirect-out/';
		var_dump(siteToVar($siteLink));

	?>		
</div>
<div class="navigate_arrow">
	<a href="/curl/2_err-check/">Назад</a>
	<a href="/curl/4_https_enabl/">Вперёд</a>
</div>