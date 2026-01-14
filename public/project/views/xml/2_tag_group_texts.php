<h4>Тексты группы XML тегов в PHP</h4>
<p>
	Пусть теперь в XML у нас есть несколько тегов:
</p>
<code>
	<pre>
		//file: test2.xml

		&lsaquo;xml version="1.0"&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;tag&rsaquo;text1&lsaquo;/tag&rsaquo;
			&lsaquo;tag&rsaquo;text2&lsaquo;/tag&rsaquo;
			&lsaquo;tag&rsaquo;text3&lsaquo;/tag&rsaquo;
		&lsaquo;/root&rsaquo;
	</pre>
</code>
<p>
	Теперь в свойстве $xml->tag будет хранится итерируемый объект:
</p>
<code>
	<pre>
		&lsaquo;?php
			var_dump($xml->tag); // итерируемый объект
		?&rsaquo;
	</pre>
</code>
<p>
	Давайте переберем наш итерируемый объект циклом и выведем значения наших тегов:
</p>
<code>
	<pre>
		&lsaquo;?php
			foreach ($xml->tag as $tag) {
				echo $tag; // 'text1', 'text2', 'text3'
			}
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
			//file: names.xml

			&lsaquo;xml version="1.0"&rsaquo;
			&lsaquo;root&rsaquo;
				&lsaquo;name&rsaquo;john&lsaquo;/name&rsaquo;
				&lsaquo;name&rsaquo;eric&lsaquo;/name&rsaquo;
				&lsaquo;name&rsaquo;kyle&lsaquo;/name&rsaquo;
			&lsaquo;/root&rsaquo;
		</pre>
	</code>
	<p>
		<i>
			Выведите на экран имя каждого юзера.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('xml_files/names.xml');
			foreach($xml->name as $tag){
				echo $tag.'&lsaquo;br/>';	
			}	
		?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/names.xml');
			foreach($xml->name as $tag){
				echo $tag.'<br/>';	
			}
		?>
</div>
<div class="navigate_arrow">
	<a href="/xml/1_tag_text/">Назад</a>
	<a href="/xml/3_tag_attribute/">Вперёд</a>
</div>
	