<h4>Соединение с БД через PDO в PHP</h4>
<p>
    Давайте выполним соединение с БД через PDO. Для начала запишем доступы в переменные:
    <br/>
    <pre>
&lt;?php
	$host = 'localhost'; // имя хоста (как правило, всегда такое)
	$db = 'test';        // имя БД
	$user = 'root';      // имя для входа в БД
	$pass = 'root';      // пароль для входа в БД
?>
    </pre>
    Теперь нам нужно сформировать строку в специальном формате. В этой строке мы должны указать тип используемой БД (как правило, 'mysql'), имя хоста и имя БД:
    <br/>
    <pre>
&lt;?php
	$dsn = "mysql:host=$host; dbname=$db; charset=utf8";
?>
    </pre>
    Затем создаем массив опций PDO, которыми мы будем пользоваться в процессе работы (пока в них не вникайте):
    <pre>
&lt;?php
	$opt = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
	];
?>
    </pre>
    Теперь мы можем выполнить подключение к базе данных, используя объявленные выше переменные:
    <br/>
    <pre>
&lt;?php
	$pdo = new PDO($dsn, $user, $pass, $opt);
?>
    </pre>
    Приведенный выше код либо выполнит подключение к базе данных, либо выбросит исключение. Поэтому более правильно обернуть подключение в конструкцию try-catch:
    <pre>
&lt;?php
	try {
		$pdo = new PDO($dsn, $user, $pass, $opt);
		echo 'DB is connected';
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
?>
    </pre>
    Полный код будет выглядеть так:
    <br/>
    <pre>
&lt;?php
	$host = 'localhost';
	$db = 'test';
	$user = ''; // имя для входа в БД
	$pass = ''; // пароль для входа в БД
	$charset = 'utf8';
	
	$dsn = "mysql:host=$host; dbname=$db; charset=$charset";
	
	$opt = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
	];
	
	try {
		$pdo = new PDO($dsn, $user, $pass, $opt);
		echo 'DB is connected';
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
?>
    </pre>
</p>
<div class="task">
	<h3>Задача</h3>
    Установите соединение с вашей БД описанным в уроке способом.
    <h4>Решение:</h4>
	<pre>
&lt;?php
    // данные можно взять из наших констант определённых в фале config.php
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
        echo 'DB is connected';
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
    </pre>

    <h4>Результат:</h4>
    <?php
        $host = DB_HOST;
        $db = DB_NAME;
        $user = DB_USER; // имя для входа в БД
        $pass = DB_PASS; // пароль для входа в БД
        $charset = 'utf8';

        $dsn = "mysql:host=$host; dbname=$db; charset=$charset";
        
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        try {
            $pdo = new PDO($dsn, $user, $pass, $opt);
            echo 'DB is connected';
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/0_intro/">Назад</a>
	<a href="/pdo/3_pdo_query/">Вперёд</a>
</div>