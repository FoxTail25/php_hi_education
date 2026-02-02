<h4>API для CRUD операций в PHP</h4>
<p>
	Часто API создается для CRUD операций. Давайте распишем пример такого API.
</p>

<h5>Read всех</h5>
<p>
	Пусть следующий URL возвращает все записи из БД:
</p>
<code>
	<pre>
&lsaquo;?php
	GET http://phphi.local/testapi/crud-api?action=all
?>	
	</pre>
</code>
<h5>Read одной</h5>
<p>
	Пусть следующий URL возвращает одну запись из БД по ее id:
</p>
<code>
	<pre>
&lsaquo;?php
	GET http://phphi.local/testapi/crud-api?action=get&id=1
?>	
	</pre>
</code>
<h5>Delete</h5>
<p>
	Пусть следующий URL удаляет одну запись из БД по ее id:
</p>
<code>
	<pre>
&lsaquo;?php
	GET http://phphi.local/testapi/crud-api?action=del&id=1
?>	
	</pre>
</code>
<h5>Update</h5>
<p>
	Пусть следующий URL принимает новые данные записи из БД через метод POST и изменяет эту запись по ее id:
</p>
<code>
	<pre>
&lsaquo;?php
	POST http://phphi.local/testapi/crud-api?action=edit&id=1
?>	
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Реализуйте описанный API.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Для начал добавим новый метод в файл core/model.php
	</p>
<code>
	<pre>
&lsaquo;?php
	protected function addOrDelOne($query) {
		$result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
		return $result;
	}
?>	
	</pre>
</code>
	<p>
		Теперь в файле project/models/crudcitiesmodel.php напишем наши методы для обращения к базе данных.
	</p>
<code>
	<pre>
&lsaquo;?php
	namespace Project\Models;
	use \Core\Model;
	
	class Crudcitiesmodel extends Model {
		public function getAllCities() {
			return $this->findMany("SELECT * FROM cities");
		}
		public function getCityById($cityId) {
			return $this->findOne("SELECT * FROM cities WHERE id=$cityId");
		}
		public function addCity($cityName, $countryId) {
			return $this->addOrDelOne("INSERT INTO cities SET name='$cityName', country_id='$countryId'");
		}
		public function deleteCityById($cityId) {
			return $this->addOrDelOne("DELETE FROM cities WHERE id='$cityId'");
		}
		public function updateCityById($newCityName, $cityId) {
			return $this->addOrDelOne("UPDATE cities SET name='$newCityName' WHERE id=$cityId");
		}
	}
?>	
	</pre>
</code>
	<p>
		Теперь в файле project/views/testapi/crudapi.php напишем логику работы нашего API
	</p>
<code>
	<pre>
&lsaquo;?php
use \Project\Models\Crudcitiesmodel;
$crudApi = new Crudcitiesmodel;

if(isset($_GET['action'])) {
	$answer = '';
	switch($_GET['action']){
		case 'all':
		$answer = $crudApi->getAllCities();
		break;
		case 'get': 
		$answer = $crudApi->getCityById($_GET['id']);
		break;
		case 'del': 
		$answer =  $crudApi->deleteCityById($_GET['id']);
		break;
	}
	echo json_encode($answer);

} else if (isset($_POST['action'])) {
	$answer = '';
	switch($_POST['action']){
		case 'add':
		$data = json_decode($_POST['jsondata'],true);
		$cityName = $data['name'];
		$countryId = $data['countryid'];
		$answer = $crudApi->addCity($cityName, $countryId);
		break;
		
		case 'update':
		$data = json_decode($_POST['jsondata'],true);
		$newCityName = $data['newCityName'];
		$cityId = $data['cityId'];
		$answer = $crudApi->updateCityById($newCityName, $cityId);
		break;
	}
	echo $answer;

} else {
	echo 'Это адрес api, для работы с ним надо отправить GET или POST запрос.';
}
?>	
	</pre>
</code>

	<p>
		Теперь пишем код, который будет работать на этой странице, что бы протестировать работоспособность нашего API
	</p>

	<code>
		<pre>
&lsaquo;?php

// функция для получения и выведения всех городов
	function getAllCities(){
		$res = '&lsaquo;h5>Все города в базе данных&lsaquo;/h5>';
		$url = "http://phphi.local/testapi/crudapi?action=all";
		$answ = file_get_contents($url);
		foreach(json_decode($answ,true) as $city){
			$res .= "$city[id] $city[name]&lsaquo;br/>";
		}
		return $res;
	}
// функция для получения и выведения города по его id
	function getCityById($cityId){
		echo "&lsaquo;h5>Город с id = $cityId&lsaquo;/h5>";
		$url = "http://phphi.local/testapi/crudapi?action=get&id=$cityId";
		$res = json_decode(file_get_contents($url), true);
		return "$res[id] $res[name]";
	}
// функция для добавления нового города
	function addCity($cityName, $countryId = 1){
		echo "&lsaquo;h5>Добавляем город $cityName&lsaquo;/h5>";
		$url = "http://phphi.local/testapi/crudapi";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		$json = json_encode(['name'=>$cityName, 'countryid'=>$countryId]);
		$data = ['action'=>'add', 'jsondata'=>$json];
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$res = curl_exec($curl);
		if ($res) {
			echo "Город $cityName добавлен";
		}
	}
// функция для изменения имени города
	function updateCityName($newCityName, $oldCityName){
		echo "&lsaquo;h5>Меняем имя города $oldCityName на $newCityName&lsaquo;/h5>";

		$url = "http://phphi.local/testapi/crudapi?action=all";
		$res = file_get_contents($url);
		$cityId ='';
		foreach(json_decode($res,true) as $city){
			if($city['name'] == $oldCityName){
				$cityId = $city['id'];
			}
		}
		$url = "http://phphi.local/testapi/crudapi";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		$json = json_encode(['newCityName'=>$newCityName, 'cityId'=>$cityId]);
		$data = ['action'=>'update', 'jsondata'=>$json];
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$res = curl_exec($curl);
		if ($res) {
			echo "Имя города $oldCityName заменено на $newCityName";
		}
	}
// функция для удаления города из БД
	function deleteCityByName($cityName){
		$url = "http://phphi.local/testapi/crudapi?action=all";
		$res = file_get_contents($url);
		foreach(json_decode($res,true) as $city){
			if($city['name'] == $cityName){

				$answ = file_get_contents("http://phphi.local/testapi/crudapi?action=del&id=$city[id]");
				if($answ){
					echo "&lsaquo;h5>Удаляем город $cityName&lsaquo;/h5>";
					echo "город с id = $city[id] удалён.";
				};
			}
		}
	}

	$oldCityName = 'TestCity';
	$newCityName = 'Test222City';
	// выводим все города
	echo getAllCities(); 

	// выводим город по его id
	echo getCityById(1);

	// добавляем город
	addCity($oldCityName);

	// выводим все города
	echo getAllCities();

	// Переименовываем город
	updateCityName($newCityName, $oldCityName);

	// выводим все города
		echo getAllCities();

	// удаляем город
	deleteCityByName($newCityName);	

	// выводим все города
	echo getAllCities();
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php

// функция для получения и выведения всех городов
	function getAllCities(){
		$res = '<h5>Все города в базе данных</h5>';
		$url = "http://phphi.local/testapi/crudapi?action=all";
		$answ = file_get_contents($url);
		foreach(json_decode($answ,true) as $city){
			$res .= "$city[id] $city[name]<br/>";
		}
		return $res;
	}
// функция для получения и выведения города по его id
	function getCityById($cityId){
		echo "<h5>Город с id = $cityId</h5>";
		$url = "http://phphi.local/testapi/crudapi?action=get&id=$cityId";
		$res = json_decode(file_get_contents($url), true);
		return "$res[id] $res[name]";
	}
// функция для добавления нового города
	function addCity($cityName, $countryId = 1){
		echo "<h5>Добавляем город $cityName</h5>";
		$url = "http://phphi.local/testapi/crudapi";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		$json = json_encode(['name'=>$cityName, 'countryid'=>$countryId]);
		$data = ['action'=>'add', 'jsondata'=>$json];
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$res = curl_exec($curl);
		if ($res) {
			echo "Город $cityName добавлен";
		}
	}
// функция для изменения имени города
	function updateCityName($newCityName, $oldCityName){
		echo "<h5>Меняем имя города $oldCityName на $newCityName</h5>";

		$url = "http://phphi.local/testapi/crudapi?action=all";
		$res = file_get_contents($url);
		$cityId ='';
		foreach(json_decode($res,true) as $city){
			if($city['name'] == $oldCityName){
				$cityId = $city['id'];
			}
		}
		$url = "http://phphi.local/testapi/crudapi";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		$json = json_encode(['newCityName'=>$newCityName, 'cityId'=>$cityId]);
		$data = ['action'=>'update', 'jsondata'=>$json];
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$res = curl_exec($curl);
		if ($res) {
			echo "Имя города $oldCityName заменено на $newCityName";
		}
	}
// функция для удаления города из БД
	function deleteCityByName($cityName){
		$url = "http://phphi.local/testapi/crudapi?action=all";
		$res = file_get_contents($url);
		foreach(json_decode($res,true) as $city){
			if($city['name'] == $cityName){

				$answ = file_get_contents("http://phphi.local/testapi/crudapi?action=del&id=$city[id]");
				if($answ){
					echo "<h5>Удаляем город $cityName</h5>";
					echo "город с id = $city[id] удалён.";
				};
			}
		}
	}

	$oldCityName = 'TestCity';
	$newCityName = 'Test222City';
	// выводим все города
	echo getAllCities(); 

	// выводим город по его id
	echo getCityById(1);

	// добавляем город
	addCity($oldCityName);

	// выводим все города
	echo getAllCities();

	// Переименовываем город
	updateCityName($newCityName, $oldCityName);

	// выводим все города
		echo getAllCities();

	// удаляем город
	deleteCityByName($newCityName);	

	// выводим все города
	echo getAllCities();

	?>		

</div>
<div class="navigate_arrow">
	<a href="/api/9_database-api/">Назад</a>
	<a href="/api/11_auth/">Вперёд</a>
</div>