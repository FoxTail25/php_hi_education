<h4>Проблемы запросов в PDO в PHP</h4>
<p>
    Как вы уже должны знать, SQL запросы подвержены SQL-инъекциям. Расширение PDO призвано бороться с инъекциями, но просто так, по умолчанию, оно этого не делает.<br/>
    Давайте посмотрим на проблему на примере. Пусть у нас есть следующий запрос, в который вставляется переменная:
    <pre>
        $sql = "SELECT * FROM users WHERE id=$id";
	    $res = $pdo->query($sql);
    </pre>
    Пусть наша переменная приходит откуда-то извне, например, из GET-параметра. Для простоты, однако, давайте просто зададим ее значение вручную. Мы ожидаем некоторое числовое значение, например, такое:
    <pre>
        $id = 1;
    </pre>
    Злобный хакер, однако, может передать следующее значение (считаем, что у нас есть поле role):
    <pre>
    	$id = '-1 OR role="admin"';
    </pre>
    Получается, что мы хотели следующий запрос:
    <pre>
    	$sql = "SELECT * FROM users WHERE id=1";
	    $res = $pdo->query($sql);
    </pre>
    А получили следующий, который вытягивает администратора сайта:
    <pre>
        $sql = "SELECT * FROM users WHERE id=-1 OR role="admin"";
	    $res = $pdo->query($sql);
    </pre>
    Чтобы избежать такой ситуации, в PDO предусмотрен специальный механизм, который называется подготовленные запросы. Их мы будем разбирать в следующем уроке.
</p>
<div class="task">
	<h3>Задача</h3>
    Намеренно осуществите SQL-инъекцию к вашей базе.
    <h4>Решение:</h4>
	<pre>
&lt;?php
    // Помним что $pdo у нас уже получен в коде выше
    
    $id = '-1 OR age > 22';
    $sql = "SELECT * FROM pdo_users WHERE id=$id";
    $res = $pdo->query($sql);
    while($row = $res->fetch()){
        echo '<i>'.$row['name'].': '.$row['age'].'</i><br/>';
    }
    </pre>
    <h4>Результат:</h4>
    <?php
    $result = require_once($_SERVER['DOCUMENT_ROOT'].'/project/config/pdo.php');
    if($result['connect']) {
        $pdo = $result['pdo'];
    } else {
        echo $result['connect_msg'];
    }
   

    $id = '-1 OR age > 22';
    $sql = "SELECT * FROM pdo_users WHERE id=$id";
    $res = $pdo->query($sql);
    while($row = $res->fetch()){
        echo '<i>'.$row['name'].': '.$row['age'].'</i><br/>';
    }
    ?>
</div>
<div class="navigate_arrow">
	<a href="/pdo/3_pdo_query/">Назад</a>
	<a href="/pdo/5_prepared-statements/">Вперёд</a>
</div>