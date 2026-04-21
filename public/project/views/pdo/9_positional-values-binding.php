<h4>Позиционная привязка переменных в PDO в PHP</h4>
<p>
    Можно привязывать переменные к запросу по одной. Это делается с помощью метода bindValue. Затем полученный запрос исполняют, но в этом случае в execute ничего не передается.<br/>
    Такая привязка позволяет точно указать тип переменной, отменяя автооборачивание в кавычки для числовых значений. Давайте посмотрим, как это делается. Пусть у нас есть две переменные, строковая и числовая:
    <pre>
        $name = 'name1';
	    $age  = 25;
    </pre>
    Подготовим запрос:
    <pre>
        $sql = 'SELECT * FROM users WHERE name=? or age=?';
        $res = $pdo->prepare($sql);    
    </pre>
    Теперь привяжем переменные к запросу с помощью метода bindValue. В первом параметре метода указывается номер позиции в запросе, во втором параметре - имя переменной, а в третьем указывается тип переменной (числовой или строковый):
    <pre>	
        $res->bindValue(1, $name, PDO::PARAM_INT);
        $res->bindValue(2, $age,  PDO::PARAM_STR);
    </pre>
    Выполним запрос:
    <pre>
        $res->execute();
    </pre>
    Посмотрим на результат:
    <pre>
        while ($row = $res->fetch()) {
		    var_dump($row);
        }
    </pre>
</p>
<div class="task">
	<h3>Задача</h3>
   
    Даны переменные:
    <pre>
	    $name1 = 'name1';
	    $name2 = 'name4';
    </pre>
    Получите юзеров, у которых имя совпадает со значением одной или второй переменной.

    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users WHERE name=? OR name=?';
            
            $res = $pdo->prepare($sql);

            $name1 = 'name1';
	        $name2 = 'name4';

            $res->bindValue(1, $name1,  PDO::PARAM_STR);
            $res->bindValue(2, $name2,  PDO::PARAM_STR);

            $res->execute();
            
            while ($row = $res->fetch()) {
                echo 'name: '. $row['name'].' | age: '.$row['age'].'| salary: '.$row['salary'].'<br/>';
            }

    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users WHERE name=? OR name=?';
            
        $res = $pdo->prepare($sql);

        $name1 = 'name1';
        $name2 = 'name4';

        // $res->bindValue(1, $name, PDO::PARAM_INT);
        $res->bindValue(1, $name1,  PDO::PARAM_STR);
        $res->bindValue(2, $name2,  PDO::PARAM_STR);


        $res->execute();
        
        while ($row = $res->fetch()) {
            echo 'name: '. $row['name'].' | age: '.$row['age'].'| salary: '.$row['salary'].'<br/>';
        }

    ?>
</div>
    <div class="task">
	<h3>Задача</h3>
   
    Даны переменные:
    <pre>
	    $age1 = 21;
	    $age2 = 22;
    </pre>
    Получите юзеров, у которых возраст совпадает со значением одной или второй переменной.

    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users WHERE name=? OR name=?';
            
            $res = $pdo->prepare($sql);

            $age1 = 21;
            $age2 = 22;

            $res->bindValue(1, $age1, PDO::PARAM_INT);
            $res->bindValue(2, $age2, PDO::PARAM_INT);

            $res->execute();
            
            while ($row = $res->fetch()) {
                echo 'name: '. $row['name'].' | age: '.$row['age'].'| salary: '.$row['salary'].'<br/>';
            }

    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users WHERE age=? OR age=?';
            
        $res = $pdo->prepare($sql);

 	    $age1 = 21;
	    $age2 = 22;

        $res->bindValue(1, $age1, PDO::PARAM_INT);
        $res->bindValue(2, $age2, PDO::PARAM_INT);

        $res->execute();
        
        while ($row = $res->fetch()) {
            echo 'name: '. $row['name'].' | age: '.$row['age'].'| salary: '.$row['salary'].'<br/>';
        }

    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/8_autowrapping-placeholders-quotes/">Назад</a>
	<a href="/pdo/10_named-values-binding/">Вперёд</a>
</div>