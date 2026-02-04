<h4>API с авторизацией в PHP</h4>
<p>
	Можно сделать так, чтобы API было не публичным, а закрытым, доступным только по паролю. В этом случае при обращении к нашему API в каждом запросе помимо параметров нужно будет передать правильный пароль. Такой пароль называется токеном.
</p>
<p>
	Пользователи нашего API должны будут получить этот токен каким-то образом. Например, купить его. В этом случае у каждого купившего будет свой токен.
</p>
<p>
	Давайте посмотрим работу с токенами на примере. Пусть наше API параметром будет принимать число, а возвращать квадрат этого числа. Давайте сделаем это API закрытым. Приступим к реализации.
</p>
<p>
	Для начала для простоты сделаем один общий токен и будем хранить его в открытом виде в файле:
</p>
<code>
	<pre>
&lsaquo;?php
	$token = '12345';
?>	
	</pre>
</code>	
<p>
	Вот так мы будем обращаться к нашему API, передавая параметр и токен:
</p>
http://api.loc/index.php?num=100&token=12345
<p>
	Реализуем API с проверкой токена:
</p>
<code>
	<pre>
&lsaquo;?php
	$token = '12345';
	
	if (isset($_GET['token']) and $_GET['token'] === $token) {
		if (isset($_GET['num'])) {
			echo $_GET['num'] ** 2;
		} else {
			echo 'error';
		}
	} else {
		echo 'incorrect token';
	}
?>	
	</pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Сделайте API, которое параметром будет принимать дату дня рождения и возвращать сколько дней осталось до этой даты. Сделайте авторизацию по токену.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Пишем API в файле projact/views/testapi/tokenapi.php
	</p>
	<code>
		<pre>
&lsaquo;?php
	$token = '12345';
	// Пишем обработчик запроса
	if(isset($_GET['token']) and $_GET['token'] == $token){
		if(isset($_GET['dateBirth'])){
			echo getAnswer($_GET['dateBirth']);
		} else {
			echo 'Дата рождения отсутствует';
		}
	} else {
		echo 'Ошибочный токен';
	}
	// функция формирования ответа.
	function getAnswer($birthDate){
		if($birthDate > date('Y-m-d')){
			$res = "В этом году, ";
			$res.= "через ".getDayDiff($_GET['dateBirth'])." дней.";
		} else {
			$res = "В следующем году ";
			$res .="через ".getDayDiff($_GET['dateBirth'], true)." дней.";
		}	
		echo $res;
	}
	// функция расчёта разницы в днях, между 2мя датами
	function getDayDiff($date, $nextYear = false){
		$now = date_create('now');
		$birthDate = date_create($date);
		if($nextYear){
			$nextYearNow = date_create($date);
			date_modify($nextYearNow, '+1 year');
			return date_diff($birthDate, $nextYearNow)->format('%a') - date_diff($birthDate, $now)->format('%a');;
		}
		return date_diff($birthDate, $now)->format('%a');
	}
?>	
		</pre>
	</code>	
	<p>
	Пишем код для проверки работы нашего API
	</p>
	<code>
		<pre>
&lsaquo;?php
// Получаем дату +3 дня от настоящей
	$future = date_modify(date_create("now"), "+3 day");
// Получаем дату -3 дня от настоящей
	$past = date_modify(date_create("now"), "-3 day");
// функция получения ответа от API	
	function getQueryData($date){
			$url = "http://phphi.local/testapi/tokenapi?dateBirth=$date&token=12345";
			$res = file_get_contents($url);
			return $res;
		}
	echo getQueryData(date_format($future, 'Y-m-d'));
	echo "&lsaquo;br/>";
	echo getQueryData(date_format($past, 'Y-m-d'));
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php
		$future = date_modify(date_create("now"), "+3 day");
		$past = date_modify(date_create("now"), "-3 day");
		function getQueryData($date){
			$url = "http://phphi.local/testapi/tokenapi?dateBirth=$date&token=12345";
			$res = file_get_contents($url);
			return $res;
		}
		echo getQueryData(date_format($future, 'Y-m-d'));
		echo "<br/>";
		echo getQueryData(date_format($past, 'Y-m-d'));
	?>		
</div>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Модифицируйте предыдущую задачу так, чтобы и параметр, и токен передавались методом POST.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Пишем API в файле projact/views/testapi/tokenapipost.php
	</p>
	<p>
		<i>
			Логику работы и код в API оставляем теми же. Только меняем $_GET на $_POST
		</i>
	</p>
	<code>
		<pre>
&lsaquo;?php
$token = '12345';
if(isset($_POST['token']) and $_POST['token'] == $token){
	if(isset($_POST['dateBirth'])){
		echo getAnswer($_POST['dateBirth']);
	} else {
		echo 'Дата рождения отсутствует';
	}
} else {
	echo 'Ошибочный токен';
}
function getAnswer($birthDate){
	if($birthDate > date('Y-m-d')){
		$res = "В этом году, ";
		$res.= "через ".getDayDiff($_POST['dateBirth'])." дней.";
	} else {
		$res = "В следующем году ";
		$res .="через ".getDayDiff($_POST['dateBirth'], true)." дней.";
	}	
	echo $res;
}
function getDayDiff($date, $nextYear = false){
	$now = date_create('now');
	$birthDate = date_create($date);
	if($nextYear){
		$nextYearNow = date_create($date);
		date_modify($nextYearNow, '+1 year');
		return date_diff($birthDate, $nextYearNow)->format('%a') - date_diff($birthDate, $now)->format('%a');;
	}
	return date_diff($birthDate, $now)->format('%a');
}
?>	
		</pre>
	</code>	
	<p>
	Пишем код для проверки работы нашего API
	</p>
	<p>
		<i>
			Нам необходимо поменять только функцию отправки запроса к API
		</i>
	</p>
	<code>
		<pre>
&lsaquo;?php
// Получаем дату +3 дня от настоящей
	$future = date_modify(date_create("now"), "+3 day");
// Получаем дату -3 дня от настоящей
	$past = date_modify(date_create("now"), "-3 day");
// функция получения ответа от API через POST запрос	
	function getQueryPostData($date){
		$url = "http://phphi.local/testapi/tokenapipost";
		$curl = curl_init();
		$token = '12345';
		$data = ['token'=>$token, 'dateBirth'=>$date];

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		
		return curl_exec($curl);
	}
	echo getQueryPostData(date_format($future, 'Y-m-d'));
	echo "&lsaquo;br/>";
	echo getQueryPostData(date_format($past, 'Y-m-d'));
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php
		$future = date_modify(date_create("now"), "+3 day");
		$past = date_modify(date_create("now"), "-3 day");
		function getQueryPostData($date){
			$url = "http://phphi.local/testapi/tokenapipost";
			$curl = curl_init();
			$token = '12345';
			$data = ['token'=>$token, 'dateBirth'=>$date];

			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			
			return curl_exec($curl);
		}
		echo getQueryPostData(date_format($future, 'Y-m-d'));
		echo "<br/>";
		echo getQueryPostData(date_format($past, 'Y-m-d'));
	?>		
</div>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Модифицируйте предыдущую задачу так, чтобы токен передавался через HTTP заголовок X-Token.
		</i>
	</p>


	<h4>Решение:</h4>

	<p>
		Пишем API в файле projact/views/testapi/tokenapipost.php
	</p>
	<p>
		<i>
			Логику работы и код в API оставляем теми же. Но теперь проверяем токен в заколовке запроса
		</i>
	</p>
	<code>
		<pre>
&lsaquo;?php
$token = '12345';
if(isset($_SERVER['HTTP_X_TOKEN']) and $_SERVER['HTTP_X_TOKEN'] == $token){
	if(isset($_POST['dateBirth'])){
		echo getAnswer($_POST['dateBirth']);
	} else {
		echo 'Дата рождения отсутствует';
	}
} else {
	echo 'Ошибочный токен';
}
function getAnswer($birthDate){
	if($birthDate > date('Y-m-d')){
		$res = "В этом году, ";
		$res.= "через ".getDayDiff($_POST['dateBirth'])." дней.";
	} else {
		$res = "В следующем году ";
		$res .="через ".getDayDiff($_POST['dateBirth'], true)." дней.";
	}	
	echo $res;
}
function getDayDiff($date, $nextYear = false){
	$now = date_create('now');
	$birthDate = date_create($date);
	if($nextYear){
		$nextYearNow = date_create($date);
		date_modify($nextYearNow, '+1 year');
		return date_diff($birthDate, $nextYearNow)->format('%a') - date_diff($birthDate, $now)->format('%a');;
	}
	return date_diff($birthDate, $now)->format('%a');
}
?>	
		</pre>
	</code>	
	<p>
	Пишем код для проверки работы нашего API
	</p>
	<p>
		<i>
			Нам необходимо добавить отправку токена заголовком запроса.
		</i>
	</p>
	<code>
		<pre>
&lsaquo;?php
// Получаем дату +3 дня от настоящей
	$future = date_modify(date_create("now"), "+3 day");
// Получаем дату -3 дня от настоящей
	$past = date_modify(date_create("now"), "-3 day");
// функция получения ответа от API через POST запрос	
	function getQueryPostData($date){
		$url = "http://phphi.local/testapi/tokenapipost";
		$curl = curl_init();
		$token = '12345';
		$data = ['dateBirth'=>$date];

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		$headers = [
			"X-Token: $token" // ВАЖНО!! Отправляем заголовок "X-Token", в запросе он будет: "HTTP_X_TOKEN"!!!!
		];
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		
		return curl_exec($curl);
	}
	echo getQueryPostData(date_format($future, 'Y-m-d'));
	echo "&lsaquo;br/>";
	echo getQueryPostData(date_format($past, 'Y-m-d'));
?>	
		</pre>
	</code>

	<h4>Результат:</h4>
	<?php
		$future = date_modify(date_create("now"), "+3 day");
		$past = date_modify(date_create("now"), "-3 day");
		function getQueryPostDataHeader($date){
			$url = "http://phphi.local/testapi/tokenapipostheader";
			$curl = curl_init();
			$token = '12345';
			$data = ['dateBirth'=>$date];

			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

			$headers = [
				"X-Token: $token" // ВАЖНО!! Отправляем заголовок "X-Token", в запросе он будет: "HTTP_X_TOKEN"!!!!
			];
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			
			return curl_exec($curl);
		}
		echo getQueryPostDataHeader(date_format($future, 'Y-m-d'));
		echo "<br/>";
		echo getQueryPostDataHeader(date_format($past, 'Y-m-d'));
	?>		
</div>