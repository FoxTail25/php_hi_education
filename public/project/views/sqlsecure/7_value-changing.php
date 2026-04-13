<h4>Подмена значения в SQL в PHP</h4>
<p>
    Давайте рассмотрим следующую уязвимость. Она связана с тем, что ваш код не отслеживает допустимые значения параметров и злоумышленник может произвольно их изменять.<br/>
    Посмотрим на примере. Пусть в таблице с юзерами поле role имеет значение 1 для админа и 2 для обычного юзера.<br/>
    Пусть у вас есть следующая форма для регистрации. В этой форме вы жестко задаете, что новый юзер будет обычным, не админом. Вы решили сделать это с помощью скрытого инпута:
    <pre>
&lt;form action="" method="POST">
	&lt;input name="login">
	&lt;input name="password" type="password">
	&lt;input name="role" type="hidden" value="2">
	&lt;input type="submit">
&lt;/form>
    </pre>
    По нажатию на кнопку отправки форму логин, пароль и роль пользователя должны занестись в базу данных с помощью INSERT запроса, вот так:
    <pre>
&lt;?php
	$login = $_POST['login'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	
	$query = "INSERT INTO users SET
		login='$login',
		password='$password',
		role=$role
	";
	
	mysqli_query($link, $query);
?>
    </pre>
    Проблема тут в том, что злоумышленник может легко поменять роль нового пользователя. Ведь то, что поле скрыто - совсем не мешает увидеть его в отладчике браузера и отредактировать его значение. Таким образом злоумышленник может сменить значение на 1 и зарегистрировать нового пользователя в качестве администратора.<br/>
    Чтобы избавиться от такой уязвимости, мы должны жестко прописать роль нового пользователя в SQL запросе:<br/>
    <pre>
&lt;?php
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	$query = "INSERT INTO users SET
		login='$login',
		password='$password',
		role=2
	";
	
	mysqli_query($link, $query);
?>
    </pre>
</p>
<div class="task">
	<h3>Задача</h3>
    В приведенном коде также есть возможность провести SQL-инъекцию. Придумайте, как ее сделать. Воспользуйтесь уявимостью. Устраните уязвимость.
    <pre>
&lt;?php
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	$query = "INSERT INTO users SET
		login='$login',
		password='$password',
		role=2
	";
	
	mysqli_query($link, $query);
?>
    </pre>
	<h4>Решение:</h4>
    <pre>
&lt;?php
	$login = mysqli_real_escape_string($link, $_POST['login']);
	$password = mysqli_real_escape_string($link, $_POST['password']);
	
	$query = "INSERT INTO users SET
		login='$login',
		password='$password',
		role=2
	";
	
	mysqli_query($link, $query);
?>
    </pre>
</div>
<div class="navigate_arrow">
	<a href="/sqlsecure/6_error_hide/">Назад</a>
	<a href="/sqlsecure/8_value_list/">Вперёд</a>
</div>