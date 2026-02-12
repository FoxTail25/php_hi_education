<h4>API с ЧПУ (Человечески Понятный Интерфейс)</h4>
<p>
    Давайте теперь сделаем API адреса в виде ЧПУ. К примеру, будем передавать первое и второе число:
</p>
<p>
    <i>
        http://api.loc/1/100/
    </i>
</p>
<p>
    Для реализации ЧПУ для начала сделаем файл htaccess, в котором все запросы будем отправлять на index.php:
</p>
<p>
    <i>
        RewriteRule .+ index.php
    </i>
</p>
<p>
    В файле index.php будем получать запрошенный URI:
</p>
<code>
	<pre>
&lsaquo;?php
	$uri = $_SERVER['REQUEST_URI'];
?>	
	</pre>
</code>	
<p>
    После получения URI можно выполнить разбор параметров и показать случайное число в заданном диапазоне:
</p>
<code>
	<pre>
&lsaquo;?php
	preg_match('#^/([0-9]+)/([0-9]+)/?$#', $uri, $match);
	
	if (isset($match[1]) and isset($match[2])) {
		echo mt_rand($match[1], $match[2]);
	} else {
		echo 'error';
	}
?>	
	</pre>
</code>	
<div class="task">
	<h3>Задача</h3>
	<p>
        Реализуйте API для работы с годами, в соответствии с описанным ниже поведением.
	</p>
    <p>
        <i>
            Проверяет год на високосность:
            http://api.loc/leap/2025/
        </i>
    </p>
    <p>
        <i>
            Возвращает разницу между годами:
            http://api.loc/diff/2025/2030/
        </i>
    </p>


	<h4>Решение:</h4>

	<p>
        Реализуем эту задачу внутри нашего конспекта. Для этого вместо ЧПУ будем использвать наш паттерн MVC. Первое что нам необходимо сделать, это добавить 2 новых метода в файл контроллера project\controllers\TestapiController.php
	</p>
    <p>
		Теперь он будет выглядеть вот так:
    </p>

	<code>
		<pre>
&lsaquo;?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class TestapiController extends Controller	{
		
		public function getPage($params) {
			$this->layout = 'zero'; // пустой layout

			$name = $params['theme'];					
			
			return $this->render("testapichpu/$name");
		}

		public function getLeap($params) {
			$this->layout = 'zero'; // пустой layout

			$year = $params['year'];
			
			return $this->render("testapi/leap", ['year'=> $year]);
		}
		
		public function getDiff($params) {
			$this->layout = 'zero'; // пустой layout

			$year1 = $params['year1'];
			$year2 = $params['year2'];
			
			return $this->render("testapi/diff", ['year1'=> $year1, 'year2'=> $year2]);
		}
	}
?>	
		</pre>
	</code>	
	<p>
		Теперь вносим коррективы в файл 
	</p>
	<code>
		<pre>
&lsaquo;?php

?>	
		</pre>
	</code>	
	<p>

	</p>
	<code>
		<pre>
&lsaquo;?php

?>	
		</pre>
	</code>

	<h4>Результат:</h4>
		<input id="leap_year_inp" type="number" min="1" max="<?=date('Y')+1000 ?>"/>
		<button id="leap_form_btn">проверить на високосность</button>
		<div id="answer"></div>
	<script>
		const inp = document.querySelector("#leap_year_inp");
		const queryBtn = document.querySelector("#leap_form_btn");
		const answerPlace = document.getElementById("answer");
		queryBtn.addEventListener('click', ()=>{
			fetch('http://phphi.local/leap/' + inp.value)
			.then(response => response.text())
			.then(data => {
					if(data == 1){
						answerPlace.innerText = 'високосный год';
					} else {
						answerPlace.innerText = 'не високосный год';
					}
				})
		})
	</script>
	<?php

    // $res = file_get_contents("http://phphi.local/diff/2025/2026");
    // echo $res;

	?>		
</div>