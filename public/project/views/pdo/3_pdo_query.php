<h4>Запросы к БД через PDO в PHP</h4>
<p>
    Переменная $pdo, которую мы получили после подключения к базе, представляет собой ООП объект. У этого объекта есть специальный метод query, осуществляющий SQL запросы. Давайте сделаем какой-нибудь тестовый запрос к нашей таблице:
    <pre>
        $res = $pdo->query('SELECT * FROM users');
    </pre>
    В переменной $res будет хранится результат запроса. Для того, чтобы получить один ряд из результата нужно использовать метод fetch:
    <pre>
$row = $res->fetch();
var_dump($row); // первый ряд

$row = $res->fetch();
var_dump($row); // второй ряд

$row = $res->fetch();
var_dump($row); // третий ряд
    </pre>    
    Когда ряды закончатся, метод выдаст null. Поэтому удобно получать ряды в следующем цикле:
    <pre>
while ($row = $res->fetch()) {
    var_dump($row);
}
    </pre>
    Давайте для примера выведем имена юзеров в отдельных абзацах:
    <pre>
    while ($row = $res->fetch()) {
		echo '<p>' . $row['name'] . '</p>';
	}
    </pre>
    Соберем весь код вместе:
    <pre>
	$res = $pdo->query('SELECT name FROM users');
	
while ($row = $res->fetch()) {
    echo '<p>' . $row['name'] . '</p>';
}
    </pre>
</p>

<div class="task">
	<h3>Задача</h3>
    Выведите зарплату всех пользователей из таблицы users.
    <h4>Решение:</h4>
	<pre>
&lt;?php
    // Для удобства, вынесем подключение к БД в отдельный файл
    // В папку project/config добавим файл pdo.php 
    // со следующим содержимым:

    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;
    $charset = 'utf8';

    $dsn = "mysql:host=$host; dbname=$db; charset=$charset";
    
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $opt);
        // echo 'DB is connected';
        $connect_msg = 'DB is connected';
        $connect = true;
    } catch(PDOException $e) {
        // echo "Connection failed: " . $e->getMessage();
        $connect_msg = "Connection failed: " . $e->getMessage();
        $connect = false;
    }
    return ['pdo'=>$pdo, 'connect_msg'=>$connect_msg, 'connect' => $connect];

    // Теперь подключим переменную $pdo:

    $result = require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
    if($result['connect']) {
        $pdo = $result['pdo'];
    } else {
        echo $result['connect_msg'];
    }
    // Теперь получим и отобразим данные из таблицы
    $res = $pdo->query("SELECT * FROM pdo_users");
    while($row = $res->fetch()){
        echo $row['salary'].'&lt;br/>';
    }
?>
    </pre>

    <h4>Результат:</h4>
    <?php
    $result = require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
    if($result['connect']) {
        $pdo = $result['pdo'];
    } else {
        echo $result['connect_msg'];
    }
    $res = $pdo->query("SELECT * FROM pdo_users");
    while($row = $res->fetch()){
        echo $row['salary'].'<br/>';
    }
     
    ?>
</div>

<div class="task">
	<h3>Задача</h3>
    Выведите все записи в формате <i>имя: возраст.</i>
    <h4>Решение:</h4>
	<pre>
&lt;?php
    // Помним что $pdo у нас уже получен в коде выше
$res = $pdo->query("SELECT * FROM pdo_users");
while($row = $res->fetch()){
    echo '&lt;i>'.$row['name'].': '.$row['age'].'&lt;/i>&lt;br/>';
}
    </pre>
    <h4>Результат:</h4>
    <?php
    $res = $pdo->query("SELECT * FROM pdo_users");
    while($row = $res->fetch()){
        echo '<i>'.$row['name'].': '.$row['age'].'</i><br/>';
    }
    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/2_pdo_connect/">Назад</a>
	<a href="/pdo/4_queries-problem/">Вперёд</a>
</div>