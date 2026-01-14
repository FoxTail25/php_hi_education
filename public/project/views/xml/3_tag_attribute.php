<h4>Атрибуты XML тега в PHP</h4>
<p>
	Пусть теперь у тега есть атрибуты:
</p>
<code>
	<pre>
		//file: test2.xml

		&lsaquo;xml version="1.0"&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;tag attr="val"&rsaquo;text&lsaquo;/tag&rsaquo;
		&lsaquo;/root&rsaquo;
	</pre>
</code>
<p>
	Получим значение атрибута. Для этого нужно обратиться к $xml->tag как к массиву:
</p>
<code>
	<pre>
		&lsaquo;?php
			echo $xml->tag['attr']; // выведет 'val'
		?&rsaquo;
	</pre>
</code>
<p>
	При этом, если просто вывести $xml->tag, то мы получим текст тега:
</p>
<code>
	<pre>
		&lsaquo;?php
			echo $xml->tag; // выведет 'text'
		?&rsaquo;
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Дан следующий XML:
		</i>
	</p>
	<code>
		<pre>
			//file: user.xml

			&lsaquo;xml version="1.0"&rsaquo;
			&lsaquo;root&rsaquo;
				&lsaquo;user age="23" salary="1000">john&lsaquo;/user>
			&lsaquo;/root&rsaquo;
		</pre>
	</code>
	<p>
		<i>
			Выведите на экран имя, возраст и зарплату юзера.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('xml_files/user.xml');
			echo $xml->user.'&lsaquo;br/>';
			echo $xml->user['age'].'&lsaquo;br/>';
			echo $xml->user['salary'].'&lsaquo;br/>';
		?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/user.xml');
			echo $xml->user.'<br/>';
			echo $xml->user['age'].'<br/>';
			echo $xml->user['salary'].'<br/>';
		?>
</div>
<div class="navigate_arrow">
	<a href="/xml/2_tag_group_texts/">Назад</a>
	<a href="/xml/4_tag_group_attr/">Вперёд</a>
</div>