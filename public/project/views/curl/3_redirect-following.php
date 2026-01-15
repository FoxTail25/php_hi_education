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
	
	<h4>Решение:</h4>
	<code>
		<pre>
			//page1.php
		&lsaquo;?php
			header('Location: page2.php');
			die();
		?>	
			//page2.php
		&lsaquo;?php
			echo 'success';
		?>	
			
		</pre>
	</code>
	<p>
		Обратитесь через CURL к первой странице. Убедитесь, что он проследует по редиректу при наличии соответствующей настройки.
	</p>
	
	<h4>Результат:</h4>
	<?php

		$siteLink = 'test2.loc';
		var_dump(siteToVar($siteLink));
	?>		
</div>