<h4>Именованная привязка переменных в PDO в PHP</h4>
<p>
    Аналогичным образом можно осуществлять именованную привязку переменных через bindValue. Давайте посмотрим, как это делается. Пусть у нас есть следующие переменные:
    <pre>
        $name = 'user';
	    $age  = 25;
    </pre>
    Пусть у нас также есть именованные плейсхолдеры:
    <pre>
        $sql = 'SELECT * FROM users WHERE name=:name or age=:age';
	    $res = $pdo->prepare($sql);
    </pre>
    Привяжем переменные к этим плейсхолдерам. Для этого первым параметром метода bindValue нужно указать имена плейсхолдеров:
    <pre>
        $res->bindValue('name', $name, PDO::PARAM_INT);
	    $res->bindValue('age',  $age,  PDO::PARAM_STR);
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
        
        $sql = 'SELECT * FROM pdo_users WHERE name=:name1 OR name=:name2';
            
            $res = $pdo->prepare($sql);

            $name1 = 'name1';
	        $name2 = 'name4';

            $res->bindValue('name1', $name1,  PDO::PARAM_STR);
            $res->bindValue('name2', $name2,  PDO::PARAM_STR);

            $res->execute();
            
            while ($row = $res->fetch()) {
                echo 'name: '. $row['name'].' | age: '.$row['age'].'| salary: '.$row['salary'].'<br/>';
            }

    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users WHERE name=:name1 OR name=:name2';
            
        $res = $pdo->prepare($sql);

        $name1 = 'name1';
        $name2 = 'name4';

        $res->bindValue('name1', $name1, PDO::PARAM_STR);
        $res->bindValue('name2', $name2, PDO::PARAM_STR);


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
        
        $sql = 'SELECT * FROM pdo_users WHERE age=:age1 OR age=:age2';
            
            $res = $pdo->prepare($sql);

            $age1 = 21;
            $age2 = 22;

            $res->bindValue('age1', $age1, PDO::PARAM_INT);
            $res->bindValue('age2', $age2, PDO::PARAM_INT);

            $res->execute();
            
            while ($row = $res->fetch()) {
                echo 'name: '. $row['name'].' | age: '.$row['age'].'| salary: '.$row['salary'].'<br/>';
            }

    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'SELECT * FROM pdo_users WHERE age=:age1 OR age=:age2';
            
        $res = $pdo->prepare($sql);

 	    $age1 = 21;
	    $age2 = 22;

        $res->bindValue('age1', $age1, PDO::PARAM_INT);
        $res->bindValue('age2', $age2, PDO::PARAM_INT);

        $res->execute();
        
        while ($row = $res->fetch()) {
            echo 'name: '. $row['name'].' | age: '.$row['age'].'| salary: '.$row['salary'].'<br/>';
        }

    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/9_positional-values-binding/">Назад</a>
	<a href="/pdo/11_get-column-values/">Вперёд</a>
</div>