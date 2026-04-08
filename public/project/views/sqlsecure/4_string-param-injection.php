<h4>SQL инъекция в строковый параметр в PHP</h4>
<p>
    Когда мы выполняем SQL запрос с данными, полученными от пользователя, этот пользователь может быть злоумышленником и осуществить атаку на сайт. Эта атака называется SQL инъекция. Давайте посмотрим, как проводится такая атака, чем это грозит и как он ее защититься.
<br/>
    Пусть у нас есть форма, в которую вводятся логин и пароль для авторизации пользователя:
</p>
<code>
    <pre>
	&lt;form action="" method="POST">
    	&lt;input name="login">
    	&lt;input name="password" type="password">
    	&lt;input type="submit">
	&lt;/form>
    </pre>
</code>
<p>
    Получим введенные пользователем данные в переменные:
</p>
<code>
    <pre>
    &lt;?php
	$login = $_POST['login'];
	$password = $_POST['password'];
    ?>
    </pre>
</code>
<p>
    Осуществим теперь SQL запрос на предмет того. прошел пользователь авторизацию или нет:
</p>
<code>
    <pre>
    &lt;?php
	$query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
	$res = mysqli_query($link, $query);
	$user = mysqli_fetch_assoc($res);
	
	if (!empty($user)) {
		// прошел авторизацию
	} else {
		// неверно ввел логин или пароль
	}
    ?>
    </pre>
</code>
<p>
    Пусть наш код работает с тестовой таблицей users, которая была в предыдущих уроках. Пусть должен авторизоватся админ. В этом случае мы ожидаем, что будет выполнен следующий SQL код:
</p>
<code>
    <pre>
        SELECT * FROM users WHERE login='admin' AND password='abcde'
    </pre>
</code>
<p>
    Наш код, однако, имеет уязвимость. Давайте посмотрим, как злоумышленник может воспользоваться ей и авторизоваться под админом, не зная его пароля (и даже логина).
</p>
<h5>
    Вариант 1
</h5>
<p>
    Пусть злоумышленник знает логин админа. Как правило, это вполне реальная ситуация, так как логин - это открытая информация и видна, например, в переписке.
<br/>
    В этом случае злоумышленник может ввести в инпут для логина следующий текст:
</p>
<code>
    <pre>
        admin' -- // ВАЖНО!! после -- идёт один пробел!!!!
    </pre>
</code>
<br/>
    Так как мы сразу подставляем текст из инпутов в запрос, то фактически у нас выполнится следующий SQL:
<br/>
<code>
    <pre>
        SELECT * FROM users WHERE login='admin' --' AND password='abc'
    </pre>
</code>
<p>
    Давайте разберем полученный запрос. Текст -- является комментарием SQL, а значит дальнейшая часть запроса просто не будет выполнена.
    <br/>
    И фактически у нас получится следующий запрос:

<code>
    <pre>
        SELECT * FROM users WHERE login='admin'
    </pre>
</code>

    To есть злоумышленник отсек пароль в запросе и спокойно входит на сайт без пароля!
</p>
<h5>
    Вариант 2
</h5>
<p>
    Можно также авторизоваться под админом, вообще не зная логина. Но зная, что поле role содержит 1 для админа.
    <br/>
    В этом случае в поле с логином следует ввести следующее значение:
    <br/>
    <pre>' or role=1 -- // ВАЖНО!! после -- идёт один пробел!!!!</pre>
    В итоге наш запрос станет таким:
    <br/>
    <pre>SELECT * FROM users WHERE login='' OR role=1 --' AND password=''</pre>
    А фактически вот таким, если отбросить закомментированную часть:
    <br/>
    <pre>SELECT * FROM users WHERE login='' OR role=1</pre>
</p>
<h5>
    Вариант 3
</h5>
<p>
    Можно также авторизоваться не под амидном, а вообще под любым юзером по его id. Для этого нужно вбить в поле с логином следующий текст:
    <br/>
    <pre>' or id=1 -- // ВАЖНО!! после -- идёт один пробел!!!!</pre>
    В итоге наш запрос станет таким:
    <br/>
    <pre>SELECT * FROM users WHERE login='' OR id=1 --' AND password=''</pre>
    А фактически вот таким, если отбросить закомментированную часть:
    <br/>
    <pre>SELECT * FROM users WHERE login='' OR id=1</pre>
</p>
<h5>
    Защита
</h5>
<p>
    Давайте теперь разберемся, как защититься от такой инъеции. Для защиты от инъекции такого типа нужно обрабатывать все входящие строковые данные функцией mysqli_real_escape_string:
    <br/>
    <pre>
    &lt;?php
	$login = mysqli_real_escape_string($link, $_POST['login']);
	$password = mysqli_real_escape_string($link, $_POST['password']);
    ?>
    </pre>
    <h5>
        Замечания
    </h5>
    Здесь следует подчеркнуть, что речь идет именно про строковые параметры. С числовыми параметрами этот способ не работает. Защиту числовых параметров мы рассмотрим в следующем уроке.
    <br/>
    Также следуюет подчеркнуть, что использование mysqli_real_escape_string - самый примитивный вариант. Более продвинутым вариантом является использование подготовленных запросов. Работу с ними мы будем изучать в разделе, посвященном расширению PDO для работы с базами данных.
</p>
<div class="task">
	<h3>Задача</h3>
    Опробуйте все описанные варианты использования уязвимости. Устраните уязвимость. Убедитесь, что она исчезла.
	<h4>Решение:</h4>
    1) пишем модель для выполнения запросов к базе данных:
    <pre>
&lsaquo;?php
namespace Project\Models;
use \Core\Model;

class SqlSec extends Model {

    private static $linksec;
    
    public function __construct() {

        parent::__construct(); // выполняем родительский конструктор

        // т.к. в родительском кланссе $link задан private, мы не можем использовать его в дочернем классе и задаем его заново 

        if (!self::$linksec) { // если свойство не задано, то подключаемся 
            self::$linksec = mysqli_connect(DB_HOST, DB_USER, DB_PASS, 
                DB_NAME); 
            mysqli_query(self::$linksec, "SET NAMES 'utf8'");
        }
        
        
    }

    public function getUser($login, $pass) {
        $answer = $this->findOne("SELECT * FROM sec_users WHERE login='$login' and password='$pass'");
        if($answer) {
            return 'прошел авторизацию';
        } 
        return 'не авторизован';            
        
    }
    public function getUserSec($login, $pass) {
        $login =mysqli_real_escape_string(self::$linksec, $login);
        $pass =mysqli_real_escape_string(self::$linksec, $pass);
        $answer = $this->findOne("SELECT * FROM sec_users WHERE login='$login' and password='$pass'");

        if($answer) {
            return 'прошел авторизацию';
        } 
        return 'не авторизован';             
        
    }

}
?>
</pre>
2) Пишем форму запроса функции обработки запроса через модель:

<pre>
&lsaquo;form id="form" action="#form" method="POST">
       &lt;span>login&lsaquo;/span>
       &lt;br/>
       &lt;input name="log">
       &lt;br/>
       &lt;span>password&lsaquo;/span>
       &lt;br/>
       &lt;input name="pass">
       &lt;input type="submit" value="отправить">
   &lt;/form>
&lsaquo;?php
use \Project\Models\SqlSec;

    if(isset($_POST['log']) and isset($_POST['pass'])){
    echo 'прямое подствление логина в запрос: '.(getUserLP($_POST['log'],$_POST['pass']));
    echo '&lsaquo;br/>&lsaquo;br/>';
    echo 'использование mysqli_real_escape_string: '.(getUserLPsec($_POST['log'],$_POST['pass']));
    }
?>
&lsaquo;/div>

&lsaquo;?php
function getUserLP($login, $pass){
    $answer = (new SqlSec)->getUser($login, $pass);
    return $answer;
}
function getUserLPsec($login, $pass){  

    $answer = (new SqlSec)->getUserSec($login, $pass);
    return $answer;
}
</pre>
	<h4>Реализация:</h4>
    <div>
        подстваляем в поле "login" по очереди:
        <span style="background:gray">admin' -- </span>&nbsp; 
        <span style="background:gray">' or role=1 -- </span>&nbsp;
        <span style="background:gray">' or id=1 -- </span>&nbsp;
        <br/>нажимаем "отправить" и смотрим результат.
    </div>
    <form id="form" action="#form" method="POST">
        <span>login</span>
        <br/>
        <input name="log">
        <br/>
        <span>password</span>
        <br/>
        <input name="pass">
        <input type="submit" value="отправить">
    </form>
<?php
use \Project\Models\SqlSec;

    if(isset($_POST['log']) and isset($_POST['pass'])){
    echo 'прямое подствление логина в запрос: '.(getUserLP($_POST['log'],$_POST['pass']));
    echo '<br/><br/>';
    echo 'использование mysqli_real_escape_string: '.(getUserLPsec($_POST['log'],$_POST['pass']));
    }
?>
<?php
function getUserLP($login, $pass){
    $answer = (new SqlSec)->getUser($login, $pass);
    return $answer;
}
function getUserLPsec($login, $pass){  

    $answer = (new SqlSec)->getUserSec($login, $pass);
    return $answer;
}
?>
</div>


<div class="task">
	<h3>Задача</h3>
    Устраните уязвимость в следующем коде:
    <pre>
   &lt;?php
        $login = $_GET['login'];
        
        $query = "SELECT * FROM users WHERE login='$login'";
        $res = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($res);
        
        var_dump($user);
    ?>
    </pre>
	<h4>Решение:</h4>
    <pre>
   &lt;?php
        $login = $_GET['login'];
        
        // добавляем строку для обработки логина
        $login = mysqli_real_escape_string($link, $login);

        $query = "SELECT * FROM users WHERE login='$login'";
        $res = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($res);
        
        var_dump($user);
    ?>
    </pre>
</div>

<div class="navigate_arrow">
	<a href="/sqlsecure/3_quotes/">Назад</a>
	<a href="/sqlsecure/5_number_param_inject/">Вперёд</a>
</div>