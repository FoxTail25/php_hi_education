<h4>REST API в PHP</h4>
<p>
	Существуют специальные подходы, стандартизирующие API для общего удобства как разработчиков API, так и его пользователей.
</p>
<p>
	Одним из таких подходов является REST API. В его основе лежит идея, что для CRUD операций необходимо использовать различные методы протокола HTTP.
</p>
<p>
	Для получения данных - метод GET, для создания данных - метод POST, для изменения данных - метод PUT, для удаления данных - метод DELETE.
</p>
<p>
	Для примера давайте рассмотрим некое API, манипулирующее юзерами. Давайте посмотрим, как будут выглядеть URL для различных действий.
</p>
<p>
	Получаем всех юзеров:
</p>
<code>
	<pre>
	GET http://api.loc/users/
	</pre>
</code>
<p>
	Получаем одного юзера по его id:
</p>
<code>
	<pre>
	GET http://api.loc/user/1/
	</pre>
</code>
<p>
	Создаем юзера:
</p>
<code>
	<pre>
	POST http://api.loc/user/
	</pre>
</code>
<p>
	Изменяем юзера по Id:
</p>
<code>
	<pre>
	PUT http://api.loc/user/1/
	</pre>
</code>
<p>
	Удаляем юзера по Id:
</p>
<code>
	<pre>
	DELETE http://api.loc/user/1/
	</pre>
</code>
<p>
	Давайте посмотрим, как REST API реализуется в PHP. Тут есть некоторая проблема. Дело в том, что и PHP, и CURL поддерживают только методы GET и POST:
</p>
<code>
	<pre>
	&lsaquo;?php
	$method = $_SERVER['REQUEST_METHOD'];
	var_dump($method); // только GET и POST
	?>
	</pre>
</code>
<p>
	Поэтому для реализации REST API придется идти на хитрость. Ее суть заключается в том, что в реальности данные будут передаваться только методами GET и POST, но мы будем имитировать работу других методов с помощью кастомного HTTP заголовка. Назовем его, например, HTTP-X-HTTP-METHOD.
</p>
<p>
	Toгда мы сможем получить содержимое этого заголовка следующим образом:
</p>
<code>
	<pre>
	&lsaquo;?php
	$method = $_SERVER['HTTP-X-HTTP-METHOD'];
	?>
	</pre>
</code>
<p>
	Теперь мы можем написать реализацию API:
</p>
<code>
	<pre>
	&lsaquo;?php
	$method = $_SERVER['HTTP-X-HTTP-METHOD'];
	
	switch ($method)  {
		case 'GET':
			// ...
		break;
		case 'POST':
			// ...
		break;
		case 'PUT':
			// ...
		break;
		case 'DELETE':
			// ...
		break;
	}
	?>
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Реализуйте REST API товаров интернет магазина.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>

	</p>

	<p>

	</p>
	<p>
		<i>

		</i>
	</p>
	<code>
		<pre>
&lsaquo;?php

?>	
		</pre>
	</code>	
	<p>

	</p>
	<code>
		<pre>
&lsaquo;?php

?>	
		</pre>
	</code>	
	<p>

	</p>
	<code>
		<pre>
&lsaquo;?php

?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php
		function setCurl($link, $method, $data = false){
			$url = $link;
			$curl = curl_init();

			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POST, 1);
			if($data) {
				$productInfo = ['data'=> json_encode($data)];
				curl_setopt($curl, CURLOPT_POSTFIELDS, $productInfo);
			}

			$headers = [
				"X-HTTP-METHOD: $method" // ВАЖНО!! Отправляем заголовок "X-HTTP-METHOD", в запросе он будет: "HTTP_X_HTTP_METHOD"!!!!
			];
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			
			return curl_exec($curl);
		}
		// echo "добавляем продукт<br/>";
		// echo setCurl('http://phphi.local/i-store/product/', 'POST', ['name'=> 'product7', 'quantity'=> '7', 'price'=> 700]).'<br/>';
		echo "смотрим все продукты<br/>";
		$allProduct = setCurl('http://phphi.local/i-store/products/', 'GET');
		echo $allProduct.'<br/>';
		echo "смотрим продукт с id = 1<br/>";
		echo setCurl('http://phphi.local/i-store/product/1/', 'GET').'<br/>';
		echo "изменяем продукт с id = 1<br/>";
		echo setCurl('http://phphi.local/i-store/product/1/', 'PUT', ['name'=> 'product5', 'quantity'=> '5', 'price'=> 500]).'<br/>';
		echo "смотрим продукт с id = 1<br/>";
		echo setCurl('http://phphi.local/i-store/product/1/', 'GET').'<br/>';
		echo "изменяем продукт с id = 1<br/>";
		echo setCurl('http://phphi.local/i-store/product/1/', 'PUT', ['name'=> 'product1', 'quantity'=> '1', 'price'=> 100]).'<br/>';
		echo "смотрим продукт с id = 1<br/>";
		echo setCurl('http://phphi.local/i-store/product/1/', 'GET').'<br/>';
		$allProduct = json_decode($allProduct,true);
		$lastProd = array_pop($allProduct);
		var_dump($lastProd['id']);
		// echo setCurl('http://phphi.local/i-store/product/3/', 'DELETE').'<br/>';
	?>		
</div>