<h4>Работа с оператором LIMIT в PDO в PHP</h4>
<p>
    При работе с оператором LIMIT в подготовленном запросе, может возникнуть проблема - цифры в запросе автоматически конвертируются в строки, что в свою очередь вызовет ошибку SQL-синтаксиса.<br/>
    Можно устранить проблему с неверной интерпретацией чисел в запросе, привязав значения переменных с помощью метода bindValue и задав им числовой режим с помощью PARAM_INT:
    <pre>
        $start = 2;
        $count = 5;
        
        $res = $pdo->prepare('SELECT * FROM users LIMIT ?, ?');
        $res->bindValue(1, $start, PDO::PARAM_INT);
        $res->bindValue(2, $count, PDO::PARAM_INT);
        
        $res->execute();
        $row = $res->fetchAll();
        var_dump($row);
    </pre>
</p>
   <div class="task">
	<h3>Задача</h3>
    Составьте IN запрос, который выведет двух пользователей, начиная с третьего.
    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $start = 2;
        $count = 2;
        
        $res = $pdo->prepare('SELECT * FROM pdo_users LIMIT ?, ?');
        $res->bindValue(1, $start, PDO::PARAM_INT);
        $res->bindValue(2, $count, PDO::PARAM_INT);
        
        $res->execute();
        $row = $res->fetchAll();

        foreach($row as $person){
            echo $person['name'].' '.$person['age'].' '.$person['salary'].'<br/>';
        }
       
    ?>
</div>