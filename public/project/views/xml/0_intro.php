<h4>Формат XML в PHP</h4>
<p>
	XML представляет собой формат для хранения данных. Этот формат часто используется для обмена данными между сайтами, либо между сервером и браузером. Технически XML похож на HTML, но с любыми тегами и атрибутами.
</p>
<p>
	Давайте сделаем отдельный файл test.xml, в котором мы будем хранить тестовый документ XML.
</p>
<p>
	Для начала в этом документе нужно сделать специальную шапку, которая будет указывать на то, что у нас XML и задавать версию этого языка:
</p>
<code>
	<pre>
		//file: test.xml

		&lsaquo;?xml version="1.0"??&rsaquo;
	</pre>
</code>
<p>
	Теперь нужно сделат корневой элемент. Он будет представлять собой тег, в котором лежит весь документ. Имя этого тега может быть любым. Давайте назовем его &lsaquo;root&rsaquo;:
</p>
<code>
	<pre>
		//file: test.xml

		&lsaquo;?xml version="1.0"??&rsaquo;
		&lsaquo;root&rsaquo;
		
		&lsaquo;/root&rsaquo;
	</pre>
</code>
<p>
	Добавим теперь некоторые данные:
</p>
<code>
	<pre>
		//file: test.xml

		&lsaquo;?xml version="1.0"??&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;test&rsaquo;text&lsaquo;/test&rsaquo;
		&lsaquo;/root&rsaquo;
	</pre>
</code>
<p>
	Теперь в PHP мы можем загрузить этот элемент с помощью функции simplexml_load_file:
</p>
<code>
	<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('test.xml');			
		?&rsaquo;
	</pre>
</code>
<p>
	В переменную запишется специальный объект, с помощью которого мы сможем получать данные тегов из дерева XML:
</p>
<code>
	<pre>
		&lsaquo;?php
			var_dump($xml); // объект		
		?&rsaquo;
	</pre>
</code>
<p>
	Далее в конспекте, для краткости будет опускаться момент получения XML и будет считатьтя, что в переменной $xml хранится результат функции simplexml_load_file.
</p>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Сделайте тестовый XML файл. Получите его в PHP. Выведите результат получения через var_dump.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
			&lsaquo;?php
				$xml = simplexml_load_file('xml_files/test.xml');	
				var_dump($xml);		
			?&rsaquo;
		</pre>
	</code>
	<i><b>Примечание</b> файл test.xml находится в папке</i> <b>public/xml_files</b>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/test.xml');	
			var_dump($xml);
		?>
</div>



<div class="navigate_arrow">
	<a href="/json/7_json_parser_error/">Назад</a>
	<a href="/xml/1_tag_text/">Вперёд</a>
</div>
