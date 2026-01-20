<h4>Отправка данных методом POST через CURL в PHP</h4>
<p>
	С помощью CURL можно отправлять данные методом POST, имитируя отправку формы. Для этого нужно указать, что запрос будет делаться методом POST. Это делается с помощью следующей настройки:
</p>
<code>
	<pre>
		&lsaquo;?php
			curl_setopt($curl, CURLOPT_POST, 1);
		?>
	</pre>
</code>
<p>
	Теперь нам нужно указать передаваемые данные. Они могут содержаться в виде массива:
</p>
<code>
	<pre>
		&lsaquo;?php
			$data = ['field1'=>'value1', 'field2'=>'value2'];
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		?>
	</pre>
</code>
<p>
	Также данные могут быть указаны в виде Query String:
</p>
<code>
	<pre>
		&lsaquo;?php
			$data = 'field1=value1&field2=value2';
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		?>
	</pre>
</code>


<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Отправьте запрос на следующую страницу и получите результат:
		</i>
	</p>
	
	<h4>Решение:</h4>
	<code>
		<pre>
			// http://phphi.local/testloc/page-post1.php
		&lsaquo;?php

			if (!empty($_POST)) {
				echo json_encode($_POST);
			} else {
				echo 'error';
			}
		?>
	
	
	
		&lsaquo;?php
		$link = 'http://phphi.local/testloc/page-post1/';
		$data = ['field1'=>'value1', 'field2'=>'value2'];
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $link);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		$res = curl_exec($curl);

		echo "ответ в JSON: ";
		var_dump($res);
		echo '&lsaquo;br/>';
		echo "после декодирования JSON: ";
		var_dump(json_decode($res));
		echo '&lsaquo;br/>';
		echo "после декодирования JSON в ассоциативный массив: ";
		var_dump(json_decode($res, true));
		?>	
			
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
		$link = 'http://phphi.local/testloc/page-post1/';
		
		$data = 'field1=value1&field2=value2';
		// $data = ['field1'=>'value1', 'field2'=>'value2'];
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $link);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		$res = curl_exec($curl);

		echo "ответ в JSON: ";
		var_dump($res);
		echo '<br/>';
		echo "после декодирования JSON: ";
		var_dump(json_decode($res));
		echo '<br/>';
		echo "после декодирования JSON в ассоциативный массив: ";
		var_dump(json_decode($res, true));
	?>		
</div>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Отправьте запрос на следующую страницу и получите результат:
		</i>
	</p>
	
	<h4>Решение:</h4>
	<code>
		<pre>
			// http://phphi.local/testloc/page-post2/
		&lsaquo;?php

			if (!empty($_POST)) {
				echo $_POST['num1'] + $_POST['num2'];
			} else {
				echo 'error';
			}
		?>
		
		&lsaquo;?php
			$link = 'http://phphi.local/testloc/page-post2/';
			$data = ['num1'=>'2', 'num2'=>'3'];
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			$res = curl_exec($curl);

			echo $res;
		?>	
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
		$link = 'http://phphi.local/testloc/page-post2/';
		$data = ['num1'=>'2', 'num2'=>'3'];
		
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $link);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		$res = curl_exec($curl);

		echo $res;
		?>		
</div>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Модифицируйте вашу функцию так, чтобы вторым необязательным параметром она принимала массив данных, отправляемых методом POST.
		</i>
	</p>
	
	<h4>Решение:</h4>
	<code>
		<pre>
			// http://phphi.local/testloc/page1.php
		&lsaquo;?php
			cho 'hello world';
		?>

			// http://phphi.local/testloc/page-post2.php
		&lsaquo;?php

			if (!empty($_POST)) {
				echo $_POST['num1'] + $_POST['num2'];
			} else {
				echo 'error';
			}
		?>
		
		&lsaquo;?php
			$link1 = 'http://phphi.local/testloc/page1/';
			$link2 = 'http://phphi.local/testloc/page-post2/';
			$data = ['num1'=>'2', 'num2'=>'3'];

			function curlPost($link, $postData = false) {
				
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $link);
				if($postData){
					curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
				}
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				
				return curl_exec($curl);	
			}
			echo 'Релультат функции без POST данных: '.curlPost($link1);
			echo "&lsaquo;br/>";
			echo "&lsaquo;br/>";
			echo 'Релультат функции с данными POST: '.curlPost($link2, $data);
		?>	
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
			$link1 = 'http://phphi.local/testloc/page1/';
			$link2 = 'http://phphi.local/testloc/page-post2/';
		$data = ['num1'=>'2', 'num2'=>'3'];

		function curlPost($link, $postData = false) {
			
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $link);
			if($postData){
				curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
			}
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			return curl_exec($curl);	
		}
		echo 'Релультат функции без POST данных: '.curlPost($link1);
		echo "<br/>";
		echo "<br/>";
		echo 'Релультат функции с данными POST: '.curlPost($link2, $data);
		?>		
</div>
<div class="navigate_arrow">
	<a href="/curl/5_browser-imit/">Назад</a>
	<a href="/curl/7_cookie-send/">Вперёд</a>
</div>