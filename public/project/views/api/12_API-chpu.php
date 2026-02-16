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
		Теперь вносим коррективы в файл project/config/routes.php добавляем в массив роутов 2 сроки для обработки маршрутов API
	</p>
	<code>
		<pre>
&lsaquo;?php
    new Route('/leap/:year', 'testapi', 'getLeap'),
    new Route('/diff/:year1/:year2', 'testapi', 'getDiff'),
?>	
		</pre>
	</code>	
	<p>
Теперь осталось создать наши API. Создаём файл project/view/testapi/leap.php
	</p>
	<code>
		<pre>
&lsaquo;?php
// если год високосный, то вернётся единица. Иначе ноль.
echo date('L', mktime(0, 0, 0, 1, 1, $year))
?>	
		</pre>
	</code>
	<p>
Теперь осталось создать наши API. Создаём файл project/view/testapi/diff.php
	</p>
	<code>
		<pre>
&lsaquo;?php
function createDate($year) {
   return date_create("$year-01-01");
}
$diff = date_diff(createDate($year1), createDate($year2));
echo $diff->format('%a дней');
?>	
		</pre>
	</code>
	<p>
		Теперь осталось только написать клиентский код, для проверки нашего API
	</p>
	<code>
		<pre>
&lsaquo;input id="leap_year_inp" type="number" min="1" max="&lsaquo;?=date('Y')+1000 ?>" value = "&lsaquo;?=date('Y')?>"/>
&lsaquo;button id="leap_form_btn">проверить на високосность&lsaquo;/button>
&lsaquo;div id="answer">&lsaquo;/div>
&lsaquo;script>
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
&lsaquo;/script>
&lsaquo;input id="year1_inp" type="number" min="1" max="&lsaquo;?=date('Y')+1000 ?>" value="2025"/>
&lsaquo;input id="year2_inp" type="number" min="1" max="&lsaquo;?=date('Y')+1000 ?>" value="2026"/>
&lsaquo;button id="queryDiffBtn">получить разницу&lsaquo;/button>
&lsaquo;div id="answerDiff">&lsaquo;/div>
&lsaquo;script>
const inp1 = document.getElementById("year1_inp");
const inp2 = document.getElementById("year2_inp");
const queryDiffBtn = document.getElementById("queryDiffBtn");
const answerPlace2 = document.getElementById("answerDiff");
queryDiffBtn.addEventListener('click', ()=>{
	fetch('http://phphi.local/diff/' + inp1.value + '/' + inp2.value)
	.then(response => response.text())
	.then(data => answerPlace2.innerText = data)
})
&lsaquo;/script>
		</pre>
	</code>

	<h4>Результат:</h4>
		<input id="leap_year_inp" type="number" min="1" max="<?=date('Y')+1000 ?>" value = "<?=date('Y')?>"/>
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
		<input id="year1_inp" type="number" min="1" max="<?=date('Y')+1000 ?>" value="2025"/>
		<input id="year2_inp" type="number" min="1" max="<?=date('Y')+1000 ?>" value="2026"/>
		<button id="queryDiffBtn">получить разницу</button>
		<div id="answerDiff"></div>
	<script>
		const inp1 = document.getElementById("year1_inp");
		const inp2 = document.getElementById("year2_inp");
		const queryDiffBtn = document.getElementById("queryDiffBtn");
		const answerPlace2 = document.getElementById("answerDiff");
		queryDiffBtn.addEventListener('click', ()=>{
			fetch('http://phphi.local/diff/' + inp1.value + '/' + inp2.value)
			.then(response => response.text())
			.then(data => answerPlace2.innerText = data)
		})
	</script>
	<?php

    // $res = file_get_contents("http://phphi.local/diff/2025/2026");
    // echo $res;

	?>		
</div>
<div class="navigate_arrow">
	<a href="/api/11_auth/">Назад</a>
	<a href="/api/13_rest/">Вперёд</a>
</div>