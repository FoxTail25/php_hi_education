<h4>Подготовка к изучению API в PHP</h4>
<p>
	При работе с API всегда есть сайт, предоставляющий это API и сайты, которые это API используют.
</p>
<p>
	Давайте для тестов сделаем два сайта на локалке: сайт api.loc, раздающий API, и сайт tst.loc, обращающийся к этому API.
</p>
<p>
	Потестируем совместную работу этих сайтов. Пусть сайт (страница сайта) с API на главной странице отдает какой-нибудь текст:
</p>
<code>
	<pre>
&lsaquo;?php
	echo 'test';
?>
	</pre>
</code>
<p>
	Обратимся к этому адресу с тестового сайта и получим результат:
</p>
<code>
	<pre>
&lsaquo;?php
	$url = 'http://api.loc/index.php';
	$res = file_get_contents($url);

	var_dump($res);
?>
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Сделайте два описанных сайта и проверьте их работу.
		</i>
	</p>


	<h4>Решение:</h4>
	<p>
		<i>
			Вместо создания отдельных сайтов, я просто добавлю страницы в этот.
		</i>
	</p>

	
	<code>
		<pre>

/*
создаём контроллер по обработке адресов типа http://phphi.local/testapi/..... 
(не забыв указать нулевой layot). 
И вношу изменения в project/config/route.php
Создаю страницу с API file: project/views/testapi/test1.php
*/
	&lsaquo;?php
	echo "api test success";
	?>

// теперь с этой сраницы, к созданному api, можно обратиться вот так:
&lsaquo;?php
	$url = 'http://phphi.local/testapi/test1/';
	$res = file_get_contents($url);

	var_dump($res);
?>		
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
	$url = 'http://phphi.local/testapi/test1/';
	$res = file_get_contents($url);

	var_dump($res);
	?>		
</div>
<div class="navigate_arrow">
	<a href="/api/0_intro/">Назад</a>
	<a href="/api/2_single-url/">Вперёд</a>
</div>