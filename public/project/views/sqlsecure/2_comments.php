<h4>Комментарии в SQL запросе в PHP</h4>
<p>
    Для дальнейшей работы вам необходимо знать, как ставятся комментарии в SQL коде. Давайте посмотрим на примере. Пусть у нас есть следующий запрос:
</p>
<code>
    <pre>
&lsaquo;?php
	$query = 'SELECT * FROM users';
	$res = mysqli_query($link, $query) or die(mysqli_error($link));
?>
    </pre>
</code>
<p>
    Давайте поставим однострочный комментарий. Это делается с помощью двух дефисов:
</p>
<code>
    <pre>
&lsaquo;?php
	$query = 'SELECT * FROM users -- комментарий'; // ВАЖНО!!! Между -- и текстом комментария должен быть пробел!!!!
	$res = mysqli_query($link, $query) or die(mysqli_error($link));
?>
    </pre>
</code>
<p>
    А теперь сделаем многострочный комментарий:
</p>
<code>
    <pre>
&lsaquo;?php
	$query = 'SELECT * FROM users /*
		комментарий
	*/';
	$res = mysqli_query($link, $query) or die(mysqli_error($link));
?>
    </pre>
</code>
<div class="task">
	<h3>Задача</h3>
	<p>
		<i>
			Опробуйте два типа комментариев в своем коде.
		</i>
	</p>
	<h4>Решение:</h4>
	<code>
		<pre>
&lsaquo;?php
        use Core\Model;
        class Comments extends Model {
            function oneStrComm() {
                $query = "SELECT * FROM sec_users WHERE id = 1 -- выбираем юзера с id = 1";
                $res = $this->findOne($query);
                return $res;
            }
            function manyStrComm() {
                $query = "SELECT * FROM sec_users /*
                выбираем 
                всех
                пользователей  */";
                $res = $this->findMany($query);
                return $res;
            }
        }
        var_dump((new Comments)->oneStrComm());
        echo '&lsaquo;br/>&lsaquo;br/>';
        var_dump((new Comments)->manyStrComm());
?&rsaquo;
		</pre>
	</code>
	<h4>Результат:</h4>
		<?php
        use Core\Model;
        class Comments extends Model {
            function oneStrComm() {
                $query = "SELECT * FROM sec_users WHERE id = 1 -- выбираем юзера с id = 1";
                $res = $this->findOne($query);
                return $res;
            }
            function manyStrComm() {
                $query = "SELECT * FROM sec_users /*
                выбираем 
                всех
                пользователей  */";
                $res = $this->findMany($query);
                return $res;
            }
        }
        var_dump((new Comments)->oneStrComm());
        echo '<br/><br/>';
        var_dump((new Comments)->manyStrComm());
		?>
</div>
<div class="navigate_arrow">
	<a href="/sqlsecure/1_prepare/">Назад</a>
	<a href="/sqlsecure/3_quotes/">Вперёд</a>
</div>