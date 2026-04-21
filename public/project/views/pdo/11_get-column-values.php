<h4>Получение одного поля из таблицы в PDO в PHP</h4>
<p>
    Кроме метода fetch есть специальные метод fetchColumn, позволяющий получить значение одной колонки. Давайте посмотрим, что имеется ввиду.<br/>
    Для начала подготовим и выполним запрос. При этом укажем, что мы хотим сделать выборку только с полем name:
    <pre>
        $res = $pdo->prepare('SELECT name FROM users');
	    $res->execute();
    </pre>
    Получим результаты с помощью метода fetch:
    <pre>
        while ($col = $res->fetch()) {
            var_dump($col);
        }
    </pre>
    В результате в каждой итерации мы будем видеть массив, состоящий из одного элемента - имени юзера:
    <pre>
        ['name1']
        ['name2']
        ['name3']
    </pre>
    Давайте теперь применим fetchColumn:
    <pre>
        while ($col = $res->fetchColumn()) {
            var_dump($col);
        }
    </pre>
    В результате в каждой итерации мы будем видеть именно строку с именем юзера, а не массив:
    <pre>
        'name1'
        'name2'
        'name3'
    </pre>
</p>
   <div class="task">
	<h3>Задача</h3>
   
    Получите значения всех возрастов пользователей.

    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT age FROM pdo_users';
            
        $res = $pdo->prepare($sql);

        $res->execute();
        // получаем результат с помощью ->fetch()
        while ($row = $res->fetch()) {
            echo 'ageFetch: '. $row['age'].'&lt;br/>';
        }
        
        $res->execute(); // вторично получаем результат
        // получаем результат с помощью ->fetchColumn()
        while ($row = $res->fetchColumn()) {
            echo 'ageFetchColumn: '. $row.'&lt;br/>';
        }
    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT age FROM pdo_users';
            
        $res = $pdo->prepare($sql);

        
        $res->execute();
        
        while ($row = $res->fetch()) {
            echo 'ageFetch: '. $row['age'].'<br/>';
        }
        
        echo '<br/>';

        $res->execute();

        while ($row = $res->fetchColumn()) {
            echo 'ageFetchColumn: '. $row.'<br/>';
        }

    ?>
</div>