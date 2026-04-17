<h4>Тестовая таблица для работы с PDO в PHP</h4>
<p>
    Перед тем, как выполнять запросы к БД, создайте таблицу users со следующими записями:<br/>

	<table class="table_1">
		<tbody><tr>
			<th>id</th>
			<th>name</th>
			<th>age</th>
			<th>salary</th>
		</tr>
		<tr>
			<td>1</td>
			<td>name1</td>
			<td>21</td>
			<td>500</td>
		</tr>
		<tr>
			<td>2</td>
			<td>name2</td>
			<td>22</td>
			<td>600</td>
		</tr>
		<tr>
			<td>3</td>
			<td>name3</td>
			<td>23</td>
			<td>700</td>
		</tr>
		<tr>
			<td>4</td>
			<td>name4</td>
			<td>24</td>
			<td>800</td>
		</tr>
		<tr>
			<td>5</td>
			<td>name5</td>
			<td>25</td>
			<td>900</td>
		</tr>
	</tbody></table>
</p>
<div class="task">
	<h3>Задача</h3>
    Создать вышеприведённую таблицу в нашей базе данных.
    <h4>Решение:</h4>
	<pre>
&lt;?php
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $table_name = 'pdo_users';

    // запрос на поиск таблици по имени
	$query = "SHOW TABLES LIKE '$table_name'";
    $table_exists = mysqli_fetch_assoc(mysqli_query($link, $query));

	if($table_exists) {
		echo "таблица уже создана";
		} else {
		echo "таблиц нет. Создаём!";

        $creare_table_query = "CREATE TABLE $table_name (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(50) NOT NULL,
         age INT,
         salary INT)";

        mysqli_query($link, $creare_table_query);

		echo"таблица добавлена в базу данных";

		$data = [
			['id' =>1, 'name'=>'name1', 'age'=>21, 'salary'=>500],
			['id' =>2, 'name'=>'name2', 'age'=>22, 'salary'=>600],
			['id' =>3, 'name'=>'name3', 'age'=>23, 'salary'=>700],
			['id' =>4, 'name'=>'name4', 'age'=>24, 'salary'=>800],
			['id' =>5, 'name'=>'name5', 'age'=>25, 'salary'=>900],
		];

		function addRecordInDB($link, $id, $name,$age, $salary) {

			$add_record_query = "INSERT INTO pdo_users (name, age, salary) VALUES ('$name','$age','$salary')";			
			$res = mysqli_query($link, $add_record_query);
		}
		
		foreach($data as $record) {
			addRecordInDB($link, $record['id'], $record['name'], $record['age'], $record['salary']);
		}
		echo"таблица заполнена данными";
	}

    ?>
	</pre>
    <h4>Результат:</h4>
    <?php
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $table_name = 'pdo_users';

    // запрос на поиск таблици по имени
	$query = "SHOW TABLES LIKE '$table_name'";
    $table_exists = mysqli_fetch_assoc(mysqli_query($link, $query));

	if($table_exists) {
		echo "таблица уже создана";
		} else {
		echo "таблиц нет. Создаём!";

        $creare_table_query = "CREATE TABLE $table_name (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(50) NOT NULL,
         age INT,
         salary INT)";

        mysqli_query($link, $creare_table_query);

		echo"таблица добавлена в базу данных";

		$data = [
			['id' =>1, 'name'=>'name1', 'age'=>21, 'salary'=>500],
			['id' =>2, 'name'=>'name2', 'age'=>22, 'salary'=>600],
			['id' =>3, 'name'=>'name3', 'age'=>23, 'salary'=>700],
			['id' =>4, 'name'=>'name4', 'age'=>24, 'salary'=>800],
			['id' =>5, 'name'=>'name5', 'age'=>25, 'salary'=>900],
		];

		function addRecordInDB($link, $id, $name,$age, $salary) {

			$add_record_query = "INSERT INTO pdo_users (name, age, salary) VALUES ('$name','$age','$salary')";			
			$res = mysqli_query($link, $add_record_query);
		}
		
		foreach($data as $record) {
			addRecordInDB($link, $record['id'], $record['name'], $record['age'], $record['salary']);
		}
		echo"таблица заполнена данными";
	}

    ?>
</div>
<div class="navigate_arrow">
	<a href="/sqlsecure/0_intro/">Назад</a>
	<a href="/pdo/2_pdo_connect/">Вперёд</a>
</div>