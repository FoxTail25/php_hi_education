<h4>Именованные плейсхолдеры в PDO в PHP</h4>
<p>
    Для удобства можно использовать именованные плейсхолдеры, в которых порядок следования переменных в массиве не важен. Давайте посмотрим, как с ними работать.<br/>
    Пусть у нас опять есть следующие переменные:
    <pre>
        $min = 1;
        $max = 5;
    </pre>
    Сделаем SQL запрос, использовав именнованные плейсхолдеры. Их синтасис такой: двоеточие, а потом имя плейсходера. Восользуемся ими в запросе:
    <pre>
        $sql = 'SELECT * FROM users WHERE id>:min and id<:max';
    </pre>
    Подготавливаем запрос:
    <pre>
        $res = $pdo->prepare($sql);
    </pre>
    Выполняем запрос, передав ему параметрами ассоциативный массив, где ключами будут имена плейсхолдеров в SQL запросе, а значениями - соответствующие переменные:
    <pre>
        $res->execute([
            'min' => $min,
            'max' => $max
        ]);
    </pre>
    Можем посмотреть результат:
    <pre>
        while ($row = $res->fetch()) {
            var_dump($row);
        }
    </pre>
    Соберем все вместе и получим следующий код:
    <pre>
        $min = 1;
        $max = 5;
        
        $sql = 'SELECT * FROM users WHERE id>:min and id<:max';
        $res = $pdo->prepare($sql);
        
        $res->execute([
            'min' => $min,
            'max' => $max
        ]);
        
        while ($row = $res->fetch()) {
            var_dump($row);
        }
    </pre>
</p>
<div class="task">
	<h3>Задача</h3>
   
    Дана переменная:
    <pre>
        	$age = 22;
    </pre>
    Найдите всех пользователей, у которых возраст равен заданному в переменной значению.
    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // Пишем функцию для удобств использования

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');

        function  getSqlNamePlasehold(string $sql, array $vars, $pdo){
            // пример $sql: 
            // $sql = 'SELECT * FROM users WHERE id>:min and id<:max';
            // пример $vars: 
            // $vars = [
                //     'min' => $min,
                //     'max' => $max
                // ]
            // global $pdo;
            $res = $pdo->prepare($sql);

            $res->execute($vars);
            
            while ($row = $res->fetch()) {
                echo 'name: '. $row['name'].' | age: '.$row['age'].'| salary: '.$row['salary'].'&lt;br/>';
            }
        }

        $sql = 'SELECT * FROM pdo_users WHERE age=:age';
        $vars = ['age' => 22,];

        getSqlNamePlasehold($sql,$vars,$pdo);
        


    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');

        function  getSqlNamePlasehold(string $sql, array $vars, $pdo){
            // пример $sql: 
            // $sql = 'SELECT * FROM users WHERE id>:min and id<:max';
            // пример $vars: 
            // $vars = [
                //     'min' => $min,
                //     'max' => $max
                // ]
            // global $pdo;
            $res = $pdo->prepare($sql);

            $res->execute($vars);
            
            while ($row = $res->fetch()) {
                echo 'name: '. $row['name'].' | age: '.$row['age'].'| salary: '.$row['salary'].'<br/>';
            }
        }

        $sql = 'SELECT * FROM pdo_users WHERE age=:age';
        $vars = ['age' => 22,];

        getSqlNamePlasehold($sql,$vars,$pdo);


    ?>
</div>
<div class="task">
	<h3>Задача</h3>
   
    Даны переменные:
    <pre>
        $age1 = 20;
        $age2 = 30;
    </pre>
    Найдите всех пользователей, у которых возраст равен заданному в переменной значению.

    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // Пишем функцию для удобств использования

        $sql = 'SELECT * FROM pdo_users WHERE age>=:age1 AND age<=:age2';
        $vars = [ 'age1' => 20,'age2' => 30]

        getSqlNamePlasehold($sql,$vars,$pdo);
    </pre>
    <h4>Результат:</h4>
    <?php

        $sql = 'SELECT * FROM pdo_users WHERE age>=:age1 AND age<=:age2';
        $vars = [ 'age1' => 20,'age2' => 30];

        getSqlNamePlasehold($sql,$vars,$pdo);


    ?>
</div>
<div class="task">
	<h3>Задача</h3>
   
    Даны переменные:
    <pre>
        $age1 = 20;
        $age2 = 22;
        
        $salary1 = 900;
        $salary2 = 2000;
    </pre>
    Найдите всех пользователей, у которых возраст И зарплата лежат в диапазоне, заданном значениями переменных.

    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // Пишем функцию для удобств использования

        $sql = 'SELECT * FROM pdo_users WHERE (age>=:age1 AND age<=:age2) OR (salary>=:salary1 AND salary<=:salary2)';
        $vars = [ 'age1' => 20,'age2' => 22, 'salary1' => 900,'salary2' => 2000];

        getSqlNamePlasehold($sql,$vars,$pdo);
    </pre>
    <h4>Результат:</h4>
    <?php

        $sql = 'SELECT * FROM pdo_users WHERE (age>=:age1 AND age<=:age2) OR (salary>=:salary1 AND salary<=:salary2)';
        $vars = [ 'age1' => 20,'age2' => 22, 'salary1' => 900,'salary2' => 2000];

        getSqlNamePlasehold($sql,$vars,$pdo);
    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/6_positional-placeholders/">Назад</a>
	<a href="/pdo/8_autowrapping-placeholders-quotes/">Вперёд</a>
</div>