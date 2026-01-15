<h4>Группа XML тегов с вложенностью в PHP</h4>
<p>
	Пусть теперь у нас несколько тегов, содержащих внутри себя вложенные:
</p>
<code>
	<pre>
		//file: nestedTag.xml

		&lsaquo;xml version="1.0"&rsaquo;
		&lsaquo;root&rsaquo;
			&lsaquo;tag>
				&lsaquo;elem>
					text1
				&lsaquo;/elem>
			&lsaquo;/tag>
			&lsaquo;tag>
				&lsaquo;elem>
					text2
				&lsaquo;/elem>
			&lsaquo;/tag>
			&lsaquo;tag>
				&lsaquo;elem>
					text3
				&lsaquo;/elem>
			&lsaquo;/tag>
		&lsaquo;/root&rsaquo;
	</pre>
</code>
<p>
	Переберем наши теги циклом и выведем значения вложенных тегов:
</p>
<code>
	<pre>
	&lsaquo;?php
		$xml = simplexml_load_file('xml_files/nestedTag.xml');
		foreach($xml->tag as $tag){
			echo $tag->elem; // 'text1', 'text2', 'text3'
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
			//file: nestedUser.xml

			&lsaquo;xml version="1.0"&rsaquo;
			&lsaquo;root&rsaquo;
				&lsaquo;user>
					&lsaquo;name>
						john
					&lsaquo;/name>
					&lsaquo;surn>
						smit
					&lsaquo;/surn>
				&lsaquo;/user>
				&lsaquo;user>
					&lsaquo;name>
						eric
					&lsaquo;/name>
					&lsaquo;surn>
						wils
					&lsaquo;/surn>
				&lsaquo;/user>
				&lsaquo;user>
					&lsaquo;name>
						kyle
					&lsaquo;/name>
					&lsaquo;surn>
						tayl
					&lsaquo;/surn>
				&lsaquo;/user>
			&lsaquo;/root&rsaquo;
		</pre>
	</code>
	<p>
		<i>
			Выведите на экран имя и фамилию каждого юзера.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('xml_files/nestedUser.xml');
			foreach($xml as $user){
				echo user->name.' '.user->surn.'&lsaquo;br/>';
			}
		?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/nestedUser.xml');
			foreach($xml as $user){
				echo $user->name.' '.$user->surn.'<br/>';
			}
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
			//file: nestedProd.xml

			&lsaquo;xml version="1.0">
			&lsaquo;root>
				&lsaquo;product cost="100" amount="3">
					&lsaquo;name>
						prod1
					&lsaquo;/name>
					&lsaquo;category>
						cat1
					&lsaquo;/category>
				&lsaquo;/product>
				&lsaquo;product cost="200" amount="4">
					&lsaquo;name>
						prod2
					&lsaquo;/name>
					&lsaquo;category>
						cat2
					&lsaquo;/category>
				&lsaquo;/product>
				&lsaquo;product cost="300" amount="5">
					&lsaquo;name>
						prod3
					&lsaquo;/name>
					&lsaquo;category>
						cat3
					&lsaquo;/category>
				&lsaquo;/product>
			&lsaquo;/root>
		</pre>
	</code>
	<p>
		<i>
			Выведите на экран название, категорию, цену и количество каждого продукта.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
		&lsaquo;?php
			$xml = simplexml_load_file('xml_files/nestedProd.xml');
			foreach($xml as $user){
				echo $prod->name.' '.$prod->category.' '.$prod['cost'].' '.$prod['amount'].'&lsaquo;br/>';
			}
		?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php	
			$xml = simplexml_load_file('xml_files/nestedProd.xml');
			foreach($xml as $prod){
				echo $prod->name.' '.$prod->category.' '.$prod['cost'].' '.$prod['amount'].'<br/>';
			}
		?>
</div>
<div class="navigate_arrow">
	<a href="/xml/5_nested-tag/">Назад</a>
	<a href="/xml/7_hypen_name/">Вперёд</a>
</div>