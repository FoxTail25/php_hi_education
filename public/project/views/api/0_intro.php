<h4>API в PHP</h4>
<p>
	В интернете часто делают специальные сервисы, раздающие некоторую информацию всем желающим. К примеру, сервисы погоды или сервисы курсов валют.
</p>
<p>
	Эти сервисы для доступа к данным предоставляют API. Под API подразумевают набор URL, к которым можно обращаться ля получения данных.
</p>
<p>
	Такие API удобно использовать при создании своего сайта. К примеру, можно сделать сайт, показывающий погоду. Для этого он может воспользоваться уже существующим сторонним API.
</p>
<p>
	Также часто удобно создавать API на своем сайте на стороне бэка. А фронт часть сайта будет обращаться к этому API получая и изменяя информацию.
</p>
<p>
	В данном разделе сайта мы изучим, как создавать свои API, какие при этом есть нюансы, а также научимся работать с чужими API, применяя их в своих проектах.
</p>

<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Изучите пример <a href="https://cur.su/pages/api">API курсов валют.</a>
		</i>
	</p>


	<h4>Решение:</h4>
	<i>
		<b>
			К сожалению, предложенный выше API у меня не заработал. Я буду использовать API Центрального банка РФ 
			<a href="https://www.cbr.ru/development/SXML/">получение котировок на заданный день</a>
		</b>
		 через него, можно получить котировки на указанный день в формате XML
	</i>
	<code>
		
		<pre>
&lsaquo;?php
	// функция для получения данных
	function getData($data = false){

		if(!$data){
			$date = date('d/m/Y');
		}
		$link = "https://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $link);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$res = curl_exec($curl);

		return $res;
	}
	//создаём xml из полученной строки
	$xml = simplexml_load_string(getData());

	// вышеописанный код, можно заменить следующими 2 строками:
	// $xml = file_get_contents('https://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d/m/Y'));
	// $xml = simplexml_load_string($xml);

	//формируем таблицу
	$res = "&lsaquo;table style='margin: 0 auto;'>
			&lsaquo;caption>
				&lsaquo;h4>
					Курс рубля к другим валютам на $xml[Date]
				&lsaquo;/h4>
			&lsaquo;/caption>";
	$res .="&lsaquo;thead>
			&lsaquo;tr>
				&lsaquo;th>
					Код
				&lsaquo;/th>
				&lsaquo;th>
					Название
				&lsaquo;/th>
				&lsaquo;th>
					Стоимость в рублях
				&lsaquo;/th>
			&lsaquo;/tr>
		&lsaquo;/thead>
		&lsaquo;tbody>"; 
	foreach($xml->Valute as $valute){
		$res .= "
		&lsaquo;tr>
			&lsaquo;td>
			$valute->CharCode
			&lsaquo;/td>
			&lsaquo;td>
			$valute->Name
			&lsaquo;/td>
			&lsaquo;td style='text-align:center'>
			$valute->Value
			&lsaquo;/td>
		&lsaquo;/tr>";
	}
	$res .= "&lsaquo;/tbody>&lsaquo;/table>";

	//выводим результат на экран
	echo $res;


?>		
		</pre>
	</code>
	<h4>Результат:</h4>
	<?php
	// функция для получения данных
	function getData($data = false){

		if(!$data){
			$date = date('d/m/Y');
		}
		$link = "https://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $link);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$res = curl_exec($curl);

		return $res;
	}
	//создаём xml из полученной строки
	$xml = simplexml_load_string(getData());

	// $xml = file_get_contents('https://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d/m/Y'));
	// $xml = simplexml_load_string($xml);
	
	//формируем таблицу
	$res = "<table style='margin: 0 auto;'><caption><h4>Курс рубля к другим валютам на $xml[Date]</h4></caption>";
	$res .="<thead><tr><th>Код</th><th>Название</th><th>Стоимость в рублях</th></tr></thead><tbody>"; 
	foreach($xml->Valute as $valute){
		$res .= "<tr><td>$valute->CharCode</td><td>$valute->Name</td><td style='text-align:center'>$valute->Value</td></tr>";
	}
	$res .= "</tbody></table>";

	//выводим результат на экран
	echo $res;
	?>		
</div>


<div class="navigate_arrow">
	<a href="/curl/9_http-header/">Назад</a>
	<a href="/api/1_preparing/">Вперёд</a>
</div>