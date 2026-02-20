<h4>Использование сторонних API</h4>
<div class="task">
	<h3>Задача</h3>
	<p>
		По <a href="https://ipwhois.io/documentation">ссылке</a> находится API, получающего положение пользователя по его IP. Реализуйте на основе этого API сайт, который по заходу на страницу будет определять местоположение пользователя.
	</p>


	<h4>Решение:</h4>

<code>
	<pre>
&lsaquo;?php
// получаем данные от предложенного API:
$res = file_get_contents("http://ipwho.is/");
$res = json_decode($res,true);
?>	

// На основе полученных данных формируем ответ:
&lsaquo;div style="background:#edf2ef; padding:10px;">	
	&lsaquo;p>
		Ваша страна: &lsaquo;?=$res['country']?>
		&lsaquo;img src="&lsaquo;?=$res['flag']['img']?>" width=20 height=12>
	&lsaquo;/p>
	&lsaquo;p>Ваш город: &lsaquo;?=$res['city']?>&lsaquo;/p>
	&lsaquo;p>Ваш провайдер: &lsaquo;?=$res['connection']['isp']?>&lsaquo;/p>
	&lsaquo;p>Домен вашего провайдера: &lsaquo;?=$res['connection']['domain']?>&lsaquo;/p>
	&lsaquo;p>Ваш ip: &lsaquo;?=$res['ip']?>&lsaquo;/p>
&lsaquo;/div>
	</pre>
</code>


	<h4>Результат:</h4>
	<?php
	$res = file_get_contents("http://ipwho.is/");
	$res = json_decode($res,true);
	?>	
	<div style="background:#edf2ef; padding:10px;">	
		<p>
			Ваша страна: <?=$res['country']?>
			<img src="<?=$res['flag']['img']?>" width=20 height=12>
		</p>
		<p>Ваш город: <?=$res['city']?></p>
		<p>Ваш провайдер: <?=$res['connection']['isp']?></p>
		<p>Домен вашего провайдера: <?=$res['connection']['domain']?></p>
		<p>Ваш ip: <?=$res['ip']?></p>
	</div>
</div>
<div class="navigate_arrow">
	<a href="/api/13_rest/">Назад</a>
	<a href="/sqlsecure/0_intro/">Вперёд</a>
</div>