<h4>Позиционные плейсхолдеры в PDO в PHP</h4>
<p>
    Давайте разберемся, как работать с позиционными плейсхолдерами. Пусть у нас есть две переменных, которые мы хотели бы вставить в запрос:
    <pre>
        $min = 1;
        $max = 5;
    </pre>
    Пусть мы хотим вставить наши переменные следующим образом:
    <pre>
        $sql = "SELECT * FROM users WHERE id>$min and id<$max";
    </pre>
    Так, однако, делать не безопасно. Поэтому вместо того, чтобы вставлять переменные напрямую, заменим их на позиционные плейсхолдеры, которые представляют собой знаки вопросов:
    <pre>
        $sql = 'SELECT * FROM users WHERE id>? and id&lt;?';
    </pre>
    Теперь выполним команду, которая подготовит запрос:
    <pre>
        $res = $pdo->prepare($sql);
    </pre>
    Теперь выполним запрос, передав ему параметрами массив, содержащий наши переменные. При этом переменные будут вставлены в запрос в таком порядке, как они указаны в массиве:
    <pre>
        $res->execute([$min, $max]);
    </pre>
    После этого можем получить результат запроса:
    <pre>
        while ($row = $res->fetch()) {
            var_dump($row);
        }
    </pre>
    Соберем все вместе и получим следующий код:
    <pre>
        $min = 1;
        $max = 5;
        
        $sql = 'SELECT * FROM users WHERE id>? and id&lt;?';
        $res = $pdo->prepare($sql);
        
        $res->execute([$min, $max]);
        
        while ($row = $res->fetch()) {
            var_dump($row);
        }
    </pre>
</p>
<div class="task">
	<h3>Задача</h3>
    Даны переменные:
    <pre>
        $age = 30;
        $salary = 1000;
    </pre>
    Найдите всех пользователей, у которых возраст или зарплата равны заданным в переменных значениям.
    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // Пишем функцию для удобстви использования
        function getData($pdo, $age, $salary){
                
            $sql = 'SELECT * FROM pdo_users WHERE age=? OR salary=?';
            $res = $pdo->prepare($sql);
            
            $res->execute([$age, $salary]);
            $noData = true;

            while ($row = $res->fetch()) {
                echo $row['name'].': '.$row['age'].': '.$row['salary'].'&lt;br/>';
                $noData = false;
            }
            if($noData){
                echo 'данных соответствующих запросу нет.&lt;br/>';
            }
        }
        /// проверяем работоспособность:
        $age = 30;
        $salary = 1000;
        getData($pdo, $age, $salary);
        
        $age = 21;
        $salary = 1000;
        getData($pdo, $age, $salary);

    </pre>
    <h4>Результат:</h4>
    <?php
        $result = require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        if($result['connect']) {
            $pdo = $result['pdo'];
        } else {
            echo $result['connect_msg'];
        }

        function getData($pdo, $age, $salary){
                    
            $sql = 'SELECT * FROM pdo_users WHERE age=? OR salary=?';
            $res = $pdo->prepare($sql);
            
            $res->execute([$age, $salary]);
            $noData = true;
            while ($row = $res->fetch()) {
                echo $row['name'].': '.$row['age'].': '.$row['salary'].'<br/>';
                if($noData) $noData = false;
            }
            if($noData){
                echo 'данных соответствующих запросу нет.<br/>';
            }
        }
        
        $age = 30;
        $salary = 1000;
        getData($pdo, $age, $salary);

        $age = 21;
        $salary = 1000;
        getData($pdo, $age, $salary);


    ?>
</div>
<div class="task">
	<h3>Задача</h3>
   
    Попробуйте провести SQL-инъекцию в ваш код. Убедитесь, что она не пройдет.
    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // Пишем функцию для удобстви использования
        
        $age = 30;
        $salary = 1000;
        getData($pdo, $age, $salary);
        
        $age = 21;
        $salary = 1000;
        getData($pdo, $age, $salary);

        $age = '-1 OR salary > 1';
        $salary = 1000;
        getData($pdo, $age, $salary);

    </pre>
    <h4>Результат:</h4>
    <?php
        
        $age = 30;
        $salary = 1000;
        getData($pdo, $age, $salary);
        
        $age = 21;
        $salary = 1000;
        getData($pdo, $age, $salary);

        $age = '-1 OR salary > 1';
        $salary = 1000;
        getData($pdo, $age, $salary);


    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/5_prepared-statements/">Назад</a>
	<a href="/pdo/7_prepared-statements/">Вперёд</a>
</div>