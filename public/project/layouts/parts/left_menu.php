<div>


	<ol>
		<h4>функции</h4>
		<?php

			$dir = $_SERVER['DOCUMENT_ROOT'] . '/project/views/function';
			$files = (array_slice(scandir($dir),2));
			$result = "";
			foreach($files as $name){
				$filename = $dir . '/' . $name;
				$first_line = '';
				$handle = fopen($filename, 'r');

				if ($handle) {
					// Читаем одну строку
					$first_line = fgets($handle);
					
					// Закрываем файл
					fclose($handle);

					// Выводим первую строчку (может содержать \n в конце, которое можно убрать с помощью trim())
					$first_line = strip_tags($first_line); 
				} else {
					$first_line = "Не удалось открыть файл.";
				}

				$linkName = substr($name, 2, -4);
				$result .= "<li><a href='/function/$name/'>$first_line</a></li>";
			}
			echo $result;
		?>

	</ol>
	<ol>
		<h4>JSON</h4>
		<li><a href="/json/">Введение</a></li>
		<li><a href="/json/data_in_json/">Данные в JSON</a></li>
		<li><a href="/json/obj_in_json/">JSON в данные</a></li>
	</ol>
</div>

