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
	<p>
		<i>
			Проверьте работу реализованного API с помощью библиотеки CURL.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		<i>
			я не буду расписывать подключение к базе данных и создание таблицы для работы нашего API. Подразумевается что это уже есть и настроено.
		</i>
	</p>
	<p>
		Первое что понадобится для реализации этой задачи. Это контроллер который будет обрабатывать запросы. Создадим его в файле Project\Controllers\Istore.php  В контроллере, нам понадобятся 2 метода. Один будет обрабатывать запросы без дополнительных данный. Второй будет обрабатывать запросы с дополнительными данными. Но при этом оба метода, будут ображаться к одному и тому же API
	</p>
	<code>
		<pre>
&lsaquo;?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class IstoreController extends Controller	{
		
		public function product() {
			$this->layout = 'zero'; // пустой layout
			return $this->render("testapi/istore");
		}
		public function ProductById($params) {
			$this->layout = 'zero'; // пустой layout
			$id = $params['id'];					
			return $this->render("testapi/istore", ['id' => $id]);
		}

	}
?>	
		</pre>
	</code>	
	<p>
		Теперь добавляем роуты в наш файл с роутами. project\config\routes.php Указываем маршруты, контроллер и методы контроллера, которые будут обрабатывать маршруты.
	</p>
	<code>
		<pre>
&lsaquo;?php
    new Route('/i-store/product/:id', 'istore', 'ProductById'),
    new Route('/i-store/products/', 'istore', 'product'),
    new Route('/i-store/product/', 'istore', 'product'),
?>	
		</pre>
	</code>	
	<p>
		Теперь нам надо написать модель которая будет взаимодействовать с Базой данных. Сделаем её в файле project\models\istore.php
	</p>
	<code>
		<pre>
&lsaquo;?php
	namespace Project\Models;
	use \Core\Model;
	
	class Istore extends Model {
		public $tableName = 'istore'; // указываем названи таблицы в которой будут храниться наши данные.
		public function get($id = false){
			// метод обрабатывающий GET запросы. Если указан id то из базы возвращается 1 запись. Если нет то все записи.
			if($id){
				$result = $this->findOne("SELECT * FROM $this->tableName WHERE id ='$id'");
			} else {
				$result = $this->findMany("SELECT * FROM $this->tableName");
			}
			return $result;
		}
		public function post($newProduct){
			// метод обрабатывающий POST запросы. Добавляет новую запись в базу данных
			$result = $this->addOrDelOne("INSERT INTO $this->tableName (name, quantity, price) VALUES ('$newProduct[name]', '$newProduct[quantity]', '$newProduct[price]')");

			if($result){
				$new = json_encode($newProduct);
				return "новый продукт $new успешно добавлен";
			}
			return "возникла ошибка";
		}
		public function put($updateProduct){
			// Метод обрабатывающий PUT запросы. Изменяет запись в базе данных
			$result = $this->addOrDelOne("UPDATE $this->tableName SET name='$updateProduct[name]', quantity = '$updateProduct[quantity]', price= '$updateProduct[price]' WHERE id='$updateProduct[id]'");
			if($result){
				return "продукт с id = $updateProduct[id] успешно изменён";
			}
			return "возникла ошибка";
		}
		public function delete($id){
			// Метод обрабатывающий DELETE запросы. 
			$result = $this->addOrDelOne("DELETE FROM $this->tableName WHERE id='$id'");
			if($result){
				return "продукт с id = $id успешно удалён";
			}
			return "возникла ошибка";
		}
    }
?>	
		</pre>
	</code>	
	<p>
		Теперь всё готово к созданиюю API. Сделаем егов файле project\views\testapi\istore.php
	</p>
	<code>
		<pre>
&lsaquo;?php
	use Project\Models\Istore;
	$istore = new Istore;

	$method = $_SERVER['HTTP_X_HTTP_METHOD'];
	$answer = ''; // сюда будет записан ответ модели
	switch ($method)  {
		case 'GET':
		if(!isset($id)){
			$answer = $istore->get();
		} else {
			$answer = $istore->get($id);
		}
		break;
		case 'POST':
			$productInfo = json_decode($_POST['data'],true);
			$answer = $istore->post($productInfo);
		break;
		case 'PUT':
			$productInfo = json_decode($_POST['data'],true);
			$updateData = array_merge(['id' => $id], $productInfo);
			$answer = $istore->put($updateData);
		break;
		case 'DELETE':
			$answer = $istore->delete($id);
		break;
	}
	// переводим в json и отправляем ответ модели клиенту
	echo json_encode($answer); 
?>	
		</pre>
	</code>
	<p>
		Теперь нам осталось тлько написат проверку работы нашего API, выполнение которого можно будет увидеть ниже.
	</p>
	<code>
		<pre>
&lsaquo;?php
// пишем функцию для обращения к нашему API
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
	
	return json_decode(curl_exec($curl), true);
}
// функция формирования строки продукта
function createDataRow($product){ 
	$result = '';
	foreach($product as $key => $data){
		$result.= "$key : $data, ";
	}
	return $result = substr($result, 0, -2).'&lsaquo;br/>';
}
// функция формирования списка строк продуктов
function createList($products){
	$result ='';
	foreach($products as $product){
		$result .= createDataRow($product);
	}
	return $result.'&lsaquo;br/>';
}
echo "добавляем продукт&lsaquo;br/>";
echo setCurl('http://phphi.local/i-store/product/', 'POST', ['name'=> 'product7', 'quantity'=> 7, 'price'=> 700]).'&lsaquo;br/>&lsaquo;br/>';

echo "смотрим все продукты&lsaquo;br/>";
$allProduct = setCurl('http://phphi.local/i-store/products/', 'GET');
echo createList($allProduct);

echo "смотрим продукт с id = 1&lsaquo;br/>";
echo createDataRow(setCurl('http://phphi.local/i-store/product/1/', 'GET')).'&lsaquo;br/>';

echo "изменяем продукт с id = 1&lsaquo;br/>";
echo setCurl('http://phphi.local/i-store/product/1/', 'PUT', ['name'=> 'product5', 'quantity'=> '5', 'price'=> 500]).'&lsaquo;br/>&lsaquo;br/>';

echo "смотрим продукт с id = 1&lsaquo;br/>";
echo createDataRow(setCurl('http://phphi.local/i-store/product/1/', 'GET')).'&lsaquo;br/>';

echo "изменяем продукт с id = 1&lsaquo;br/>";
echo setCurl('http://phphi.local/i-store/product/1/', 'PUT', ['name'=> 'product1', 'quantity'=> '1', 'price'=> 100]).'&lsaquo;br/>&lsaquo;br/>';

echo "смотрим продукт с id = 1&lsaquo;br/>";
echo createDataRow(setCurl('http://phphi.local/i-store/product/1/', 'GET')).'&lsaquo;br/>';

$allProduct = setCurl('http://phphi.local/i-store/products/', 'GET');
$lastProd = array_pop($allProduct); // получаем последний продукт
$lastProdId = $lastProd['id']; // получаем id последнего продукта
echo "удаляем последний продукт&lsaquo;br/>";
echo setCurl("http://phphi.local/i-store/product/$lastProdId/", 'DELETE').'&lsaquo;br/>';

echo "смотрим все продукты&lsaquo;br/>";
$allProduct = setCurl('http://phphi.local/i-store/products/', 'GET');
echo createList($allProduct);
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php
	// пишем функцию для обращения к нашему API
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
			
			return json_decode(curl_exec($curl), true);
		}
		// функция формирования строки продукта
		function createDataRow($product){ 
			$result = '';
			foreach($product as $key => $data){
				$result.= "$key : $data, ";
			}
			return $result = substr($result, 0, -2).'<br/>';
		}
		// функция формирования списка строк продуктов
		function createList($products){
			$result ='';
			foreach($products as $product){
				$result .= createDataRow($product);
			}
			return $result.'<br/>';
		}
		echo "добавляем продукт<br/>";
		echo setCurl('http://phphi.local/i-store/product/', 'POST', ['name'=> 'product7', 'quantity'=> 7, 'price'=> 700]).'<br/><br/>';

		echo "смотрим все продукты<br/>";
		$allProduct = setCurl('http://phphi.local/i-store/products/', 'GET');
		echo createList($allProduct);

		echo "смотрим продукт с id = 1<br/>";
		echo createDataRow(setCurl('http://phphi.local/i-store/product/1/', 'GET')).'<br/>';

		echo "изменяем продукт с id = 1<br/>";
		echo setCurl('http://phphi.local/i-store/product/1/', 'PUT', ['name'=> 'product5', 'quantity'=> '5', 'price'=> 500]).'<br/><br/>';
		
		echo "смотрим продукт с id = 1<br/>";
		echo createDataRow(setCurl('http://phphi.local/i-store/product/1/', 'GET')).'<br/>';

		echo "изменяем продукт с id = 1<br/>";
		echo setCurl('http://phphi.local/i-store/product/1/', 'PUT', ['name'=> 'product1', 'quantity'=> '1', 'price'=> 100]).'<br/><br/>';
		
		echo "смотрим продукт с id = 1<br/>";
		echo createDataRow(setCurl('http://phphi.local/i-store/product/1/', 'GET')).'<br/>';

		$allProduct = setCurl('http://phphi.local/i-store/products/', 'GET');
		$lastProd = array_pop($allProduct); // получаем последний продукт
		$lastProdId = $lastProd['id']; // получаем id последнего продукта
		echo "удаляем последний продукт<br/>";
		echo setCurl("http://phphi.local/i-store/product/$lastProdId/", 'DELETE').'<br/>';

		echo "смотрим все продукты<br/>";
		$allProduct = setCurl('http://phphi.local/i-store/products/', 'GET');
		echo createList($allProduct);
	?>		
</div>
<div class="navigate_arrow">
	<a href="/api/12_API-chpu/">Назад</a>
	<a href="/api/14_using/">Вперёд</a>
</div>