<h4>Работа с HTTPS в CURL в PHP</h4>
<p>
	Следующие команды позволяют CURL получать текст сайтов, работающих через протокол HTTPS:
</p>
<code>
	<pre>
		&lsaquo;?php
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		?>
	</pre>
</code>
<p class="zametki">
	на практике выяснилось что это не обязательная настройка. Без неё тоже работает.
</p>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Обратитесь через CURL к следующему сайту, работающему на HTTPS:
		</i>
	</p>
	<code>
		<pre>
			&lsaquo;?php
				$url = 'https://code.mu';
			?>
		</pre>
	</code>

	
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php

			function siteToVar($link){

				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $link);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

				$res = curl_exec($curl);

				return $res;
			}
			$siteLink = 'https://code.mu';
			var_dump(siteToVar($siteLink));
		?>	
			
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php

		function siteToVar($link){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

			$res = curl_exec($curl);

			return $res;
		}
		$siteLink = 'https://code.mu';
		var_dump(siteToVar($siteLink));
	?>		
</div>
<div class="navigate_arrow">
	<a href="/curl/3_redirect-following/">Назад</a>
	<a href="/curl/5_browser-imit">Вперёд</a>
</div>