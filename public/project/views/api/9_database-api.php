<h4>API и БД в PHP</h4>
<p>
	Часто API используется для того, чтобы получить данные из базы данных. Давайте посмотрим на примере. Пусть у нас есть некоторая таблица с юзерами. Давайте сделаем API, которое параметром будет получать id юзера, а отдавать данные из БД для данного юзера:
</p>
<code>
	<pre>
&lsaquo;?php
	$id     = $_GET['id'];
	$query  = "SELECT * FROM users WHERE id=$id";
	$result = mysqli_query($link, $query);
	$user   = mysqli_fetch_assoc($result);

	header('Content-Type: application/json');
	echo json_encode($user, true);
?>	
	</pre>
</code>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Пусть в базе данных хранятся страны и их города. Сделайте API, которое параметром будет принимать страну и возвращать массив ее городов.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Начнём решать задачу с Базы Данных. Создадим базу которая будет состоять из 2х таблиц. 1я таблица - id и название стран.
		2я таблица id, название города и id страны. Далее, т.к. мы используем архитектурный паттерн MVC, создаём модель в файле: project/models/Cities.php:
	</p>
	<code>
		<pre>
&lsaquo;?php
	namespace Project\Models; 
	// импортируем оригинальный класс
	use \Core\Model; 
	
	// создаём на эго основе новый.
	class Cities extends Model { 
		public function getCities($CountryId) {
			return $this->findMany("SELECT * FROM cities WHERE country_id=$CountryId");
		}
	}
?>	
		</pre>
	</code>	
	<p>
		Теперь приступаем к написанию API в файле: /project/views/testapi/get-cities.php
	</p>
	<code>
		<pre>
&lsaquo;?php
	// импортируем модель для получения данных	
	use \Project\Models\Cities; 

	// пишем условие на отдачу данных
	if(isset($_GET['country_id'])){
		$country_id = $_GET['country_id'];
		echo jsonCitiesArr($country_id);
	} else {
		echo 'страна не указана';
	}

	//функция получения записей из Базы Данных
	function jsonCitiesArr($id){
		$cities = new Cities;
		$res = $cities->getCities($id);
		return json_encode($res);
	}

?>	
		</pre>
	</code>	

	<p>
		Пишем клиентскую часть нашего кода:
	</p>

	<code>
		<pre>
	&lsaquo;div>
		&lsaquo;a href="http://phphi.local/api/9_database-api?country=1#cities_list">
			Города России
		&lsaquo;/a>
	&lsaquo;/div>
	&lsaquo;div>
		&lsaquo;a href="http://phphi.local/api/9_database-api?country=2#cities_list">
			Города Белоруссии
		&lsaquo;/a>
	&lsaquo;/div>
	&lsaquo;div>
		&lsaquo;a href="http://phphi.local/api/9_database-api#reset">
			Скрыть города
		&lsaquo;/a>
	&lsaquo;/div>
&lsaquo;?php
	if(isset($_GET['country'])){
		getCountryCities($_GET['country']);
	}
	function getCountryCities($country_id){

		echo "&lsaquo;h5 id='cities_list'>Список городов&lsaquo;/h5>";
		$url = "http://phphi.local/testapi/get-cities?country_id=$country_id";
		$citiesArr = json_decode(file_get_contents($url),true);
		foreach($citiesArr as $city){
			echo "$city[name]&lsaquo;br/>";
			}
	}
?>	
		</pre>
	</code>	
	<h4>Комментарий:</h4>	
	<p>
		<i>
			<b>
				Конечно можно было бы на клиенте использовать JavaScript и AJAX (тем самым избежать полной перезагрузки страницы). Но мы практикуемся в PHP, по этому постараемся решать задачи только при помощи PHP
			</b>
		</i>
	</p>


	<h4 id="reset">Результат:</h4>
	
	<div>
		<a href="http://phphi.local/api/9_database-api?country=1#cities_list">
			Города России
		</a>
	</div>
	<div>
		<a href="http://phphi.local/api/9_database-api?country=2#cities_list">
			Города Белоруссии
		</a>
	</div>
	<div>
		<a href="http://phphi.local/api/9_database-api#reset">
			Скрыть города
		</a>
	</div>
	<?php
	if(isset($_GET['country'])){
		getCountryCities($_GET['country']);
	}
	function getCountryCities($country_id){

		echo "<h5 id='cities_list'>Список городов</h5>";
		$url = "http://phphi.local/testapi/get-cities?country_id=$country_id";
		$citiesArr = json_decode(file_get_contents($url),true);
		foreach($citiesArr as $city){
			echo "$city[name]<br/>";
			}
	}
	?>	
</div>
<div class="navigate_arrow">
	<a href="/api/8_post-parameters-json/">Назад</a>
	<a href="/api/10/">Вперёд</a>
</div>