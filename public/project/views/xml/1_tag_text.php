<h4>Текст XML тега в PHP</h4>
<p>
	Пусть в XML у нас есть один тег:
</p>
<code>
	<pre>
		//file: test.xml

		&lsaquo;?xml version="1.0"??&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;tag&rsaquo;text&lsaquo;/tag&rsaquo;
		&lsaquo;/root&rsaquo;
	</pre>
</code>
<p>
	Давайте получим текст этого тега. Его значение будет хранится в свойстве объекта $xml:
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
		//file: name.xml

		&lsaquo;?xml version="1.0"??&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;name&rsaquo;johan&lsaquo;/name&rsaquo;
		&lsaquo;/root&rsaquo;
	</pre>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('xml_files/name.xml');	
			echo $xml->name;	
		?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/name.xml');	
			echo $xml->name;
		?>
</div>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Дан следующий XML:
		</i>
	</p>
	<code>
	<pre>
		//file: name.xml

		&lsaquo;?xml version="1.0"??&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;name&rsaquo;johan&lsaquo;/name&rsaquo;
			&lsaquo;surn&rsaquo;johan&lsaquo;/surn&rsaquo;
		&lsaquo;/root&rsaquo;
	</pre>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('xml_files/name.xml');	
			echo $xml->name.' '.$xml->surn;	
		?&rsaquo;
			
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/name.xml');	
			echo $xml->name.' '.$xml->surn;
		?>
</div>
<div class="navigate_arrow">
	<a href="/xml/0_intro/">Назад</a>
	<a href="/xml/2/">Вперёд</a>
</div>