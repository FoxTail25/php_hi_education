<h4>Все ряды из результата в PDO в PHP</h4>
<p>
    Можно сразу получить массив всех рядов из результата запроса. Это делается с помощью метода fetchAll. Давайте рассмотрим различные режимы работы этого метода. Все примеры будут для тестовой таблицы.<br/>
    <h5>Получение простого массива</h5>
    Давайте применим метод fetchAll для получения простого массива данных. Для этого оставим параметры метода пустыми:
    <pre>
        $res = $pdo->query('SELECT * FROM users');
        
        $row = $res->fetchAll();
        var_dump($row);
    </pre>
    Результат выполнения кода:
    <pre>
        [
            [
                'id'     => 1,
                'name'   => 'name1',
                'age'    => 21,
                'salary' => 500,
            ],
            [
                'id'     => 2,
                'name'   => 'name2',
                'age'    => 22,
                'salary' => 600,
            ],
            [
                'id'     => 3,
                'name'   => 'name3',
                'age'    => 23,
                'salary' => 600,
            ],
            [
                'id'     => 4,
                'name'   => 'name4',
                'age'    => 24,
                'salary' => 700,
            ],
            [
                'id'     => 5,
                'name'   => 'name5',
                'age'    => 25,
                'salary' => 800,
            ],
    </pre>
    <h5>Получение записей с уникальным полем</h5>
    Можно сделать так, чтобы уникальное поле (как правило это id), стало ключом для каждого подмассива:
    <pre>
        $res = $pdo->query('SELECT * FROM users');
        
        $row = $res->fetchAll(PDO::FETCH_UNIQUE);
        var_dump($row);
    </pre>
    Результат выполнения кода:
    <pre>
        [
            1 => [
                'id'     => 1,
                'name'   => 'name1',
                'age'    => 21,
                'salary' => 500,
            ],
            2 => [
                'id'     => 2,
                'name'   => 'name2',
                'age'    => 22,
                'salary' => 600,
            ],
            3 => [
                'id'     => 3,
                'name'   => 'name3',
                'age'    => 23,
                'salary' => 600,
            ],
            4 => [
                'id'     => 4,
                'name'   => 'name4',
                'age'    => 24,
                'salary' => 700,
            ],
            5 => [
                'id'     => 5,
                'name'   => 'name5',
                'age'    => 25,
                'salary' => 800,
            ],
        ]
    </pre>
    <h5>Получение одной колонки</h5>
    Давайте получим только одну колонку из таблицы. Для этого передадим в метод fetchAll параметр FETCH_COLUMN:
    <pre>
        $res = $pdo->query('SELECT name FROM users');
        
        $row = $res->fetchAll(PDO::FETCH_COLUMN);
        var_dump($row);
    </pre>
    Результат выполнения кода:
    <pre>
        [
            'name1',
            'name2',
            'name3',
            'name4',
            'name5',
        ]
    </pre>
    <h5>Получение пары ключ-значение</h5>
    Давайте получим данные в виде пары ключ-значение, где ключом будет айди, а значением имя юзера. Для этого в параметр метода fetchAll передадим режим FETCH_KEY_PAIR:
    <pre>
        $res = $pdo->query('SELECT id, name FROM users');
        
        $row = $res->fetchAll(PDO::FETCH_KEY_PAIR);
        var_dump($row);
    </pre>
    Результат выполнения кода:
    <pre>
        [
            1 => 'name1',
            2 => 'name2',
            3 => 'name3',
            4 => 'name4',
            5 => 'name5',
        ]
    </pre>
</p>
   <div class="task">
	<h3>Задача</h3>
   
    Выведите всех пользователей из таблицы users, используя описанный в уроке метод.

    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users';

        
        $res= $pdo->query($sql);
            
        // либо можно так:
        // $res = $pdo->prepare($sql);
        // $res = $pdo->execute($sql);

        
        $rows = $res->fetchAll();
        
        foreach($row as $rows){
            echo 'name: '. $row['name'].'&lt;br/> age:'. $row['age'].'&lt;br/>';
        }
    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users';
            
        $res = $pdo->query($sql);
        $rows = $res->fetchAll();

        foreach($rows as $row){
            echo 'name: '. $row['name'].' age:'. $row['age'].'<br/>';
        }        
    ?>
</div>
   <div class="task">
	<h3>Задача</h3>
   
    Выведите один ряд данных из таблицы users.

    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users';
            
        $res = $pdo->query($sql);
        $row = $res->fetch();
        echo 'name: '. $row['name'].' age:'. $row['age'].'&lt;br/>';      
    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users';
            
        $res = $pdo->query($sql);
        $row = $res->fetch();
        echo 'name: '. $row['name'].' age:'. $row['age'].'<br/>';
    ?>
</div>
   <div class="task">
	<h3>Задача</h3>
   
    Выведите имя и возраст пользователей в виде пары ключ-значение.

    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT name, age FROM pdo_users';
            
        $res = $pdo->query($sql);
        $rows = $res->fetchAll(PDO::FETCH_COLUMN);

        foreach($rows as $row){
            echo 'name: '. $row.'&lt;br/>';
        }      
    </pre>
    <h4>Результат:</h4>
    <?php

        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT name, age FROM pdo_users';
            
        $res = $pdo->query($sql);
        $rows = $res->fetchAll(PDO::FETCH_KEY_PAIR);

        foreach($rows as $name => $age){
            echo  $name.': '.$age.'<br/>';
        }        
    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/11_get-column-values/">Назад</a>
	<a href="/pdo/13_multiple-prepared-statements/">Вперёд</a>
</div>