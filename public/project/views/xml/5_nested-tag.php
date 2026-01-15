<h4>Вложенный XML тег в PHP</h4>
<p>
	Пусть теперь у нас будет вложенный тег:
</p>
<code>
	<pre>
		// file:  nest.xml

		&lsaquo;xml version="1.0"&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;tag>
				&lsaquo;elem>text&lsaquo;/elem>
			&lsaquo;/tag>
		&lsaquo;/root&rsaquo;
	</pre>
</code>
<p>
	Давайте получим значение вложенного тега. Для этого нужно выполнить цепочку обращений:
</p>
<code>
	<pre>
	&lsaquo;?php
		$xml = simplexml_load_file('xml_files/nest.xml');
		echo $xml->tag->elem; // 'text'
		
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
			//file: nest2.xml
			&lsaquo;xml version="1.0"&rsaquo;
			&lsaquo;root&rsaquo;
				&lsaquo;tag1>
					&lsaquo;tag2>
						&lsaquo;tag3>
							text in tag3
						&lsaquo;/tag1>
					&lsaquo;/tag1>
				&lsaquo;/tag1>
			&lsaquo;/root&rsaquo;
		</pre>
	</code>
	<p>
		<i>
			Выведите на экран текст самого внутреннего тега.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('xml_files/nest2.xml');
			echo $xml->tag1->tag2->tag3;
		?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/nest2.xml');
			echo $xml->tag1->tag2->tag3;

		?>
</div>
<div class="navigate_arrow">
	<a href="/xml/4_tag_group_attr/">Назад</a>
	<a href="/xml/6_tag-group-nested/">Вперёд</a>
</div>