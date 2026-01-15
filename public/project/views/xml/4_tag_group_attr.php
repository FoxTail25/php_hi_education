<h4>Атрибуты группы XML тегов в PHP</h4>
<p>
	Пусть теперь у нас несколько тегов с атрибутами:
</p>
<code>
	<pre>
		&lsaquo;xml version="1.0"&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;user attr="val1">text1&lsaquo;/user>
			&lsaquo;user attr="val2">text2&lsaquo;/user>
			&lsaquo;user attr="val3">text2&lsaquo;/user>
		&lsaquo;/root&rsaquo;
	</pre>
</code>
<p>
	Давайте получим тексты этих тегов:
</p>
<code>
	<pre>
	&lsaquo;?php
		$xml = simplexml_load_file('xml_files/user.xml');
		foreach($xml->tag as $tag){
			echo $tag; // 'text1', 'text2', 'text3'
		}
	?&rsaquo;
	</pre>
</code>
<p>
	А теперь - значения атрибутов:
</p>
<code>
	<pre>
	&lsaquo;?php
		$xml = simplexml_load_file('xml_files/user.xml');
		foreach($xml->tag as $tag){
			echo $tag['attr']; // 'val1', 'val2', 'val3'
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
			//file: product.xml

			&lsaquo;xml version="1.0"&rsaquo;
			&lsaquo;root>
				&lsaquo;product cost="100" amount="3">prod1&lsaquo;/user>
				&lsaquo;product cost="200" amount="4">prod2&lsaquo;/user>
				&lsaquo;product cost="300" amount="5">prod3&lsaquo;/user>
			&lsaquo;/root>
		</pre>
	</code>
	<p>
		<i>
			Выведите на экран название, цену и количество каждого продукта.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('xml_files/product.xml');
			foreach($xml->product as $prod){
				echo $prod.' '.$prod['cost'].' '.$prod['amount'].'&lsaquo;br/>';
			}
		?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/product.xml');
			foreach($xml->product as $prod){
				echo $prod.' '.$prod['cost'].' '.$prod['amount'].'<br/>';
			}
		?>
</div>
<div class="navigate_arrow">
	<a href="/xml/3_3_tag_attribute/">Назад</a>
	<a href="/xml/5_nested-tag/">Вперёд</a>
</div>