<h4>Имена XML тегов с дефисами в PHP</h4>
<p>
	Пусть в имени тега у нас будет дефис:
</p>
<code>
	<pre>
		//file: nestedTag.xml

		&lsaquo;xml version="1.0"&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;tag>
				&lsaquo;elem-child>
						text
				&lsaquo;/elem-child>
			&lsaquo;/tag>
		&lsaquo;/root&rsaquo;
	</pre>
</code>
<p>
	В этом случае для обращения к такому тегу придется воспользоваться следующим приемом:
</p>
<code>
	<pre>
	&lsaquo;?php
		echo $xml->tag->{'elem-child'}; // 'text'
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
			//file: hypenName.xml

			&lsaquo;?xml version="1.0"?>
			&lsaquo;root>
				&lsaquo;user-name>john&lsaquo;/user-name>
				&lsaquo;user-surn>smit&lsaquo;/user-surn>
			&lsaquo;/root>
		</pre>
	</code>
	<p>
		<i>
			Выведите на экран имя и фамилию юзера.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('xml_files/hypenName.xml');
			echo $xml->{'user-name'}.' '.$xml->{'user-surn'};
		?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/hypenName.xml');
			echo $xml->{'user-name'}.' '.$xml->{'user-surn'};			
		?>
</div>
<div class="navigate_arrow">
	<a href="/xml/6_tag-group-nested/">Назад</a>
	<a href="/curl/0_intro/">Вперёд</a>
</div>