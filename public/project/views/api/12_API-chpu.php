<h4>API с ЧПУ (Человечески Понятный Интерфейс)</h4>
<p>
    Давайте теперь сделаем API адреса в виде ЧПУ. К примеру, будем передавать первое и второе число:
</p>
<p>
    <i>
        http://api.loc/1/100/
    </i>
</p>
<p>
    Для реализации ЧПУ для начала сделаем файл htaccess, в котором все запросы будем отправлять на index.php:
</p>
<p>
    <i>
        RewriteRule .+ index.php
    </i>
</p>
<p>
    В файле index.php будем получать запрошенный URI:
</p>
<code>
	<pre>
&lsaquo;?php
	$uri = $_SERVER['REQUEST_URI'];
?>	
	</pre>
</code>	
<p>
    После получения URI можно выполнить разбор параметров и показать случайное число в заданном диапазоне:
</p>
<code>
	<pre>
&lsaquo;?php
	preg_match('#^/([0-9]+)/([0-9]+)/?$#', $uri, $match);
	
	if (isset($match[1]) and isset($match[2])) {
		echo mt_rand($match[1], $match[2]);
	} else {
		echo 'error';
	}
?>	
	</pre>
</code>	
<div class="task">
	<h3>Задача</h3>
	<p>
        Реализуйте API для работы с годами, в соответствии с описанным ниже поведением.
	</p>
    <p>
        <i>
            Проверяет год на високосность:
            http://api.loc/leap/2025/
        </i>
    </p>
    <p>
        <i>
            Возвращает разницу между годами:
            http://api.loc/diff/2025/2030/
        </i>
    </p>


	<h4>Решение:</h4>

	<p>
        Реализуем эту задачу внутри нашего конспекта.
	</p>
    <p>

    </p>

	<code>
		<pre>
&lsaquo;?php

?>	
		</pre>
	</code>	
	<p>
		Теперь в файле project\views\testapi\tokenapipostheaderBdTen.php модернизируем локику проверки токена.
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
    	
    $res = file_get_contents("http://phphi.local/leap/2025");
    echo $res;
    echo "<br/>";
    $res = file_get_contents("http://phphi.local/diff/2025/2026");
    echo $res;

	?>		
</div>