<h4>Проверка ответа CURL на ошибку в PHP</h4>
<p>
	Если в процессе запроса случится какая-то ошибка, в переменную с результатом попадет false. Этим можно воспользоваться для проверки на ошибку:
</p>
<code>
	<pre>
	&lsaquo;?php
		// Выполняем запрос:
		$res = curl_exec($curl);
		
		if ($res === false) {
			// Выведем сообщение об ошибке:
			echo 'error';
		} else {
			// Выведем результат:
			var_dump($res);
		}
	?>
	</pre>
</code>
<p>
	С помощью функции curl_error можно получить текст ошибки, случившейся в CURL:
</p>
<code>
	<pre>
	&lsaquo;?php
		// Выполняем запрос:
		$res = curl_exec($curl);
		
		if ($res === false) {
			// Выведем ошибку:
			echo curl_error($curl);
		} else {
			// Выведем результат:
			var_dump($res);
		}
	?>
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Внесите соответствующие исправления в вашу функцию.
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

				if($res){
					return $res;
				}
				return curl_error($curl);
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
			if($res){
				return $res;
			}
			return curl_error($curl);
		}
		$siteLink = 'test.loc';
		var_dump(siteToVar($siteLink));
	?>		
</div>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Попробуйте обратиться к несуществующему сайту. Изучите текст ошибки CURL для этого случая.
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

				if($res){
					return $res;
				}
				return curl_error($curl);
			}
			$siteLink = 'test2.loc';
			var_dump(siteToVar($siteLink));
		?>	
			
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php

		$siteLink = 'test2.loc';
		var_dump(siteToVar($siteLink));
	?>		
</div>
<div class="navigate_arrow">
	<a href="/curl/1_tag_text/">Назад</a>
	<a href="/curl/3_redirect-following/">Вперёд</a>
</div>