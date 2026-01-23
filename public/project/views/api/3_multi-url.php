<h4>API несколько URL в PHP</h4>
<p>
	Давайте теперь сделаем API, в котором будет несколько URL для обращения. Для примера пусть у нас будет доступен набор следующих адресов:
</p>
<code>
	<pre>
http://api.loc/hour.php
http://api.loc/min.php
http://api.loc/sec.php
	</pre>
</code>
<p>
	Пусть обращение по первому адресу возвращает текущий час:
</p>
<code>
	<pre>
&lsaquo;?php
	echo date('H');
?>	
	</pre>
</code>
<p>
	Обращение по второму адресу возвращает текущие минуты:
</p>
<code>
	<pre>
&lsaquo;?php
	echo date('i');
?>	
	</pre>
</code>
<p>
	Обращение по третьему адресу возвращает текущие секунды:
</p>
<code>
	<pre>
&lsaquo;?php
	echo date('s');
?>	
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Сделайте API с тремя URL. Обращение к первому должно отдавать текущий день, ко второму - текущий месяц, к третьему - текущий год.
		</i>
	</p>


	<h4>Решение:</h4>
	Создаём страницу с API file: project/views/testapi/day.php
	<code>
		<pre>
&lsaquo;?php
	echo date('d');
?>
		</pre>
	</code>
	Создаём страницы с API file: project/views/testapi/month.php
	<code>
		<pre>
&lsaquo;?php
	echo date('F');
?>
		</pre>
	</code>
	Создаём страницы с API file: project/views/testapi/year.php
	<code>
		<pre>
&lsaquo;?php
	echo date('Y');
?>
		</pre>
	</code>

<p>
	Обращаемся к этим созданным страницам и выводим ответ на экран.
</p>	
	<code>
		<pre>

&lsaquo;?php
	echo file_get_contents('http://phphi.local/testapi/day/').'&lsaquo;br/>';
	echo file_get_contents('http://phphi.local/testapi/month/').'&lsaquo;br/>';
	echo file_get_contents('http://phphi.local/testapi/year/').'&lsaquo;br/>';
?>		
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
	echo file_get_contents('http://phphi.local/testapi/day/').'<br/>';
	echo file_get_contents('http://phphi.local/testapi/month/').'<br/>';
	echo file_get_contents('http://phphi.local/testapi/year/').'<br/>';
	?>		
</div>
<div class="navigate_arrow">
	<a href="/api/2_single-url/">Назад</a>
	<a href="/api/4_get-parameter/">Вперёд</a>
</div>