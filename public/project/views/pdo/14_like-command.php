<h4>Работа с оператором LIKE в PDO в PHP</h4>
<p>
    Чтобы в подготовленном запросе использовать оператор LIKE, нужно прописать значение для его переменной с помощью специального синтаксиса:
    <pre>
        $var = '%value%';
    </pre>
    Давайте найдем пользователя по имени, используя оператор LIKE:
    <pre>	
    $name = '%user1%';
	
	$res = $pdo->prepare('SELECT * FROM users WHERE name LIKE ?');
	$res->execute([$name]);
	$row = $res->fetchAll();
	var_dump($row);
    </pre>

</p>
   <div class="task">
	<h3>Задача</h3>
    Выведите всех пользователей из таблицы users, у которых зарплата равна 500.
    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');

        $salary = 500;
        $sql = 'SELECT * FROM pdo_users WHERE salary LIKE ?';
        $res = $pdo->prepare($sql);
        $res->execute([$salary]);
        $row = $res->fetchAll();
	    var_dump($row);
    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $salary = 500;
        $sql = 'SELECT * FROM pdo_users WHERE salary LIKE ?';
        $res = $pdo->prepare($sql);
        $res->execute([$salary]);
        $row = $res->fetchAll();
	    var_dump($row);
       
    ?>
</div>
   <div class="task">
	<h3>Задача</h3>
    Выведите пользователей, у которых зарплата равна или более 900, а возраст меньше 35 лет.
    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        $sql = 'SELECT * FROM pdo_users WHERE salary LIKE ? OR salary > ? AND age < ?';
        $salary = 900;
        $age = 35;
        $res = $pdo->prepare($sql);
        $res->execute([$salary, $salary, $age]);
        $row = $res->fetchAll();
        foreach($row as $person){
            echo $person['name'].' '.$person['age'].' '.$person['salary'].'&lt;br/>';
        }
    </pre>
    <h4>Результат:</h4>
    <?php

        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        // $sql = 'SELECT * FROM pdo_users WHERE salary LIKE ? OR salary > ?';
        $sql = 'SELECT * FROM pdo_users WHERE salary LIKE ? OR salary > ? AND age < ?';
        $salary = 900;
        $age = 35;
        $res = $pdo->prepare($sql);
        $res->execute([$salary, $salary, $age]);
        $row = $res->fetchAll();
        foreach($row as $person){
            echo $person['name'].' '.$person['age'].' '.$person['salary'].'<br/>';
        }
       
    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/13_multiple-prepared-statements/">Назад</a>
	<a href="/pdo/15_limit-command/">Вперёд</a>
</div>