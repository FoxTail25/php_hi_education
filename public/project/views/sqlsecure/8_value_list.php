<h4>Список значений в SQL в PHP</h4>
<p>
    В предыдущем уроке мы решили проблему с подменой значения, просто жестко задав его в коде. Это, однако, не всегда работает. Может быть так, что пользователю разрешено выбрать одно из нескольких значений.<br/>
    К примеру, у нас на сайте может быть несколько ролей: админ, ученик и учитель. Пусть пользователь может зарегистрироваться по своему выбору: или учеником, или учителем. Сделаем для этого выпадающий список:
    <pre>
&lt;form action="" method="POST">
	&lt;input name="login">
	&lt;input name="password" type="password">
	
	&lt;select name="role">
		&lt;option value="2">ученик&lt;/option>
		&lt;option value="3">учитель&lt;/option>
	&lt;/select>
	
	&lt;input type="submit">
&lt;/form>
    </pre>
    Теперь у нас нет вариантов - мы обязательно должны вставлять роль из переменной:
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
    Но мы опять возвращаемся к пробеме с подменой. Ведь злоумышленник опять может поменять значение поля, в нашем случае уже селекта, на 1 и стать админом.<br/>
    В этом случае есть два варианта решения проблемы: черный список и белый список. Давайте их рассмотрим.
    <h5>Черный список</h5>
    Под черным списком имеется ввиду набор значений, которые мы запрещаем. В нашем случае мы хотим запретить роль со значением 1. В этом случае защищенный код будет следующем:
    <pre>
&lt;?php
	$login = $_POST['login'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	
	if ($role !== 1) { // 1 в черном списке
		$query = "INSERT INTO users SET
			login='$login',
			password='$password',
			role=$role
		";
		
		mysqli_query($link, $query);
	} else {
		// попытка взлома
	}
?>
    </pre>
    <h5>Белый список</h5>
    Черные списки, однако, как правило - плохое решение. Более безопасно делать списки с разрешенными значениями. Такие списки называются белыми.<br/>
    Давайте исправим нашу уязвимость с помощью белого списка разрешенных значений:
    <pre>
&lt;?php
	$login = $_POST['login'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	$list = [2, 3]; // белый список
	
	if (in_array($role, $list)) {
		$query = "INSERT INTO users SET
			login='$login',
			password='$password',
			role=$role
		";
		
		mysqli_query($link, $query);
	} else {
		// попытка взлома
	}
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
	$role = $_POST['role'];
	$list = [2, 3]; // белый список
	
	if (in_array($role, $list)) {
		$query = "INSERT INTO users SET
			login='$login',
			password='$password',
			role=$role
		";
		
		mysqli_query($link, $query);
	} else {
		// попытка взлома
	}
?>
    </pre>
	<h4>Решение:</h4>
    <pre>
&lt;?php
	$login = mysqli_real_escape_string($link, $_POST['login']);
	$password = mysqli_real_escape_string($link, $_POST['password']);
	$role =(int) $_POST['role'];
	$list = [2, 3]; // белый список
	
	if (in_array($role, $list)) {
		$query = "INSERT INTO users SET
			login='$login',
			password='$password',
			role=$role
		";
		
		mysqli_query($link, $query);
	} else {
		// попытка взлома
	}
?>
    </pre>
</div>
<div class="navigate_arrow">
	<a href="/sqlsecure/6_error_hide/">Назад</a>
	<a href="/sqlsecure/8_value_list/">Вперёд</a>
</div>