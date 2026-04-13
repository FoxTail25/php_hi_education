<h4>Выключение ошибок SQL в PHP</h4>
<p>
    Вы уже должны знать, что на выложенном в интернет сайте вывод ошибок лучше отключать. Делается это вот так:
    <pre>
&lt;?php
	error_reporting(0);
	ini_set('display_errors', 'off');
?>
    </pre>
    Этот код, однако, выключает ошибки самого PHP, но никак не ошибки SQL! Дело в том, что классическая схема вывода ошибок SQL, описанная во всех учебниках осуществляется через функцию die:
    <pre>
&lt;?php
	$query = 'SELECT * FROM users';
	$res = mysqli_query($link, $query) or die(mysqli_error($link));
?>
    </pre>
    Понятно, что в этом случае отключение ошибок PHP не повлияет на вывод ошибок SQL. Однако, отключить ошибки SQL тоже очень важно. И дело даже не в том, что пользователь их увидит.
    <br/>
    Проблема в том, что эти ошибки будет видеть злоумышленник. А вывод ошибок SQL устроен таким образом, что в ошибке показывается часть запроса. Это значит, что намеренно создавая ошибки, злоумышленник может выяснить имена таблиц и имена полей в них! А эта информация поможет ему в дальнейшем взломе сайта.
    <br/>
    Однако, при разработке на локальном компьютере ошибки SQL нам все-таки хотелось бы видеть, для удобства. Давайте сделаем так, чтобы в режиме разработки ошибки были видны, а на продакшене (то есть в интернете) - нет.
    <br/>
    Для этого в файле config.php определим следующую константу, содержающую нужный режим:
    <pre>
&lt;?php
	define('MODE', 'prod'); // dev или prod
?>
    </pre>
    <span style="color:red;">// Файл config.php можно добавить в корень сайта. И загружаеть через файл index.php с помощью команды require_once('config.php');</span><br/><br/>
    Будем показывать ошибку только в режиме разработки:
    <pre>
&lt;?php
	$query = 'SELECT * FROM users';
	$res = mysqli_query($link, $query);
	
	if (!$res and MODE === 'dev') {
		die(mysqli_error($link))
	}
?>
    </pre>
    Для удобства, чтобы постоянно не дублировать код, можно оформить запросы в виде функции:
    <pre>
&lt;?php
	function query($link, $query)
	{
		$res = mysqli_query($link, $query);
		
		if (!$res and MODE === 'dev') {
			die(mysqli_error($link));
		}
	}
?>
    </pre> 
    И тогда с помощью нашей функции мы будем выполнять запросы вот так: 
    <pre>
&lt;?php
	query($link, 'SELECT * FROM users');
?>
    </pre> 
</p>
<div class="task">
    <h3>Задача</h3>
    Реализуйте описанное переключение режима. Потестируйте его.
    <h4>Решение:</h4>
    <pre>
        1) создаём файл в корне проекта и называем его config.php
        2) прописываем в нём следующий код:
        &lt;?php
	        define('MODE', 'dev'); // dev или prod
        ?>
        3) в файл index.php (в корне сайта) добавляем следующий код:
        require_once('config.php');
        if(MODE == "dev") {
            error_reporting(E_ALL);
            ini_set('display_errors', 'on');
        } else {
            error_reporting(0);
            ini_set('display_errors', 'off');
        }

    </pre>
    <pre>
<?php
echo "MEDE: ".MODE."<br/><br/>";
    // $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	// $query = "SELECT * FROM sec_user WHERE id = 1";
	// $res = query($link, $query);

    // function query($link, $query) {
	// 	$res = mysqli_query($link, $query);
		
	// 	if (!$res and MODE === 'dev') {
    //             // return die(mysqli_error($link));
    //         return 'ошибка SQL запроса';
    //     }
    //     if($res) {
    //         return mysqli_fetch_assoc($res);
    //     } else {
    //             return null;
    //     }
 
	// }

    // var_dump($res);
?>
    </pre>
</div>
<div class="navigate_arrow">
	<a href="/sqlsecure/5_number_param_inject/">Назад</a>
	<a href="/sqlsecure/7_value-changing/">Вперёд</a>
</div>
