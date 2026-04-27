<h4>Многократное выполнение подготовленных выражений в PDO в PHP</h4>
<p>
    Мы можем выполнять подготовленное выражение для запроса к БД несколько раз. Это немного выгоднее по ресурсом, чем подготавливать его каждый раз заново.<br/>
    Пусть для примера нам нужно сделать запросы на обновление зарплат пользователей в таблице.<br/>
    Пусть у нас уже есть ассоциативный массив, в котором в виде ключа будет указан id пользователя, а в виде значения - его зарплата:
    <pre>
        $salaries = [
		1 => 200,
		3 => 500,
		5 => 700,
	];
    </pre>
    Подготовим запрос один раз:
    <pre>
        $res = $pdo->prepare('UPDATE users SET salary=? WHERE id=?');
    </pre>
    $res = $pdo->prepare('UPDATE users SET salary=? WHERE id=?');
    <pre>
        foreach ($salaries as $id => $salary) {
		$res->execute([$salary, $id]);
	}
    </pre>
</p>
</div>
   <div class="task">
	<h3>Задача</h3>
   
    Дан массив с айдишниками и возрастами юзеров:
    <pre>
        $ages = [
            1 => 20,
            3 => 30,
            5 => 40,
        ];
    </pre>
    Напишите код, который в цикле обновит данные юзеров.

    <h4>Решение:</h4>
	<pre>
        // Помним про $pdo 
        // require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
     
    </pre>
    <h4>Результат:</h4>
    <?php

        require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
        
        $sql = 'UPDATE pdo_users SET age=? WHERE id=?';

        $ages = [
            1 => 20,
            3 => 30,
            5 => 40,
        ];
            
        $res = $pdo->prepare($sql);

        foreach($ages as $id => $age){
            $res->execute([$age,$id]);
        }        
    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/12_result-all-rows/">Назад</a>
	<a href="/pdo/14_/">Вперёд</a>
</div>