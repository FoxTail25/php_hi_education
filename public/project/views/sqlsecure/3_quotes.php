<h4>Кавычки в SQL запросах</h4>
<p>
    Бывают случаи, когда в SQL запросе мы используем текстовое значение, содержащее внутри себя кавычку. В этом случае мы получим ошибку синтаксиса SQL:
</p>
<code>
    <pre>
&lsaquo;?php
	$query = "SELECT * FROM users WHERE login='D'Artagnan'";
	$res = mysqli_query($link, $query) or die(mysqli_error($link)); // выведет ошибку
?>
    </pre>
</code>
<p>
    Для решения проблемы нужно эту кавычку экранировать с помощью обратного слеша:
</p>
<code>
    <pre>
&lsaquo;?php
	$query = "SELECT * FROM users WHERE login='D\'Artagnan'";
	$res = mysqli_query($link, $query) or die(mysqli_error($link)); 
?>
    </pre>
</code>
<P>
    Как правило, однако, текст с кавычкой мы не пишем в явном виде, а берем из переменной. Например, вот так:
</P>
<code>
    <pre>
&lsaquo;?php
	$login = 'D\'Artagnan';
	$query = "SELECT * FROM users WHERE login='$login'";
	$res = mysqli_query($link, $query) or die(mysqli_error($link));
?>
    </pre>
</code>
<P>
    Также наш текст может прийти из формы, которую заполняет пользователь. В этом случае мы получаем место, потенциально подверженное ошибке. В следующем примере будет ошибка, если пользователь введет данные с кавычкой:
</P>
<code>
    <pre>
&lsaquo;?php
	$login = $_POST['login'];
	$query = "SELECT * FROM users WHERE login='$login'";
	$res = mysqli_query($link, $query) or die(mysqli_error($link));
?>
    </pre>
</code>
<P>
    Для решения проблемы нам необходимо воспользоваться функцией с очень длинным именем: mysqli_real_escape_string. Эта функция сама заэкранирует кавычки в тексте (и некоторые другие проблемные символы тоже):
</P>
<code>
    <pre>
&lsaquo;?php
	$login = mysqli_real_escape_string($link, $_POST['login']);
	$query = "SELECT * FROM users WHERE login='$login'";
	$res = mysqli_query($link, $query) or die(mysqli_error($link));
?>
    </pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		Пусть у вас есть некоторая таблица articles со статьями. Пусть есть также следующая форма:
	</p>
    <code>
        <pre>
&lsaquo;form action="" method="POST">
	&lsaquo;input name="title">
	&lsaquo;textarea name="text">&lsaquo;/textarea>
	&lsaquo;input type="submit">
&lsaquo;/form>
        </pre>
    </code>
	<h4>Решение:</h4>
    <p>
        для решения этой задачи, мы напишем функцию по экранированию текста и добавим её на одно из полей формы.
    </p>
	<code>
		<pre>
&lsaquo;?php
    &lsaquo;form id="res" action="#res" method="POST"> // добавим форме id и пропишем action
        &lsaquo;input name="title">
        &lsaquo;br/>
        &lsaquo;textarea name="text">&lsaquo;/textarea>
        &lsaquo;br/>
        &lsaquo;input type="submit">
    &lsaquo;/form>
    &lsaquo;?php
    if(isset($_POST['title']) and $_POST['title']){ //если поле input заполнено то возвращаем его содержимое.
        echo "input (не экранировано): ".$_POST['title'].'&lsaquo;br/>';
    }
    if(isset($_POST['text']) and $_POST['text']){ //если поле textarea заполнено то возвращаем его экранируемое содержимое.
        echo "textarea (экранировано): ".ecraneQuote($_POST['text']).'&lsaquo;br/>';
    }
    function ecraneQuote($text){ //функция экранирования
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
        return mysqli_real_escape_string($link, $text);
    }
    ?>
?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
    <form id="res" action="#res" method="POST">
        <input name="title">
        <br/>
        <textarea name="text"></textarea>
        <br/>
        <input type="submit">
    </form>
    <?php
    if(isset($_POST['title']) and $_POST['title']){
        echo "input (не экранировано): ".$_POST['title'].'<br/>';
    }
    if(isset($_POST['text']) and $_POST['text']){
        echo "textarea (экранировано): ".ecraneQuote($_POST['text']).'<br/>';
    }
    function ecraneQuote($text){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME); 
        return mysqli_real_escape_string($link, $text);
    }
    ?>
</div>
<div class="navigate_arrow">
	<a href="/sqlsecure/2_comments/">Назад</a>
	<a href="/sqlsecure/4_string-param-injection/">Вперёд</a>
</div>