<?php

namespace Core;

class Menu {

	private $dir = '';
	private $menu = 'class menu';

	public function __construct(){
		$this->dir = $_SERVER['DOCUMENT_ROOT'] . '/project/views/';
	}

	public function createMenu($menuDir, $menuName = 'menu'){

		// $menuDir - название каталога из которого будет сделано меню.
		// $menuName - заголовок меню

		// Формируем массив состоящий из сылок и имён ссылок
		$menuArr = $this->createMenuArr($menuDir);
		// Записываем название меню внутри списка пунктов меню
		$result = "<ol><h4>$menuName</h4>";
		// Формируем сами пункты меню
		foreach($menuArr as $menuItem){
			$result .= "<li><a href='$menuItem[0]'>$menuItem[1]</a></li>";
		}
			
		$result .= "</ol>";
		$this->menu = $result;
		return $this;
	}

	public function CreateMenuArr($menuDir){
		$dir = $this->dir . $menuDir;

			// Читае в массив имена файлов в указанном каталоге. Отсекаем первые 2 элемента массива.
			$files = (array_slice(scandir($dir),2));
			$files = $this->sortedMenuArr($files);
			// var_dump(sort($files));
			$resultArr = [];

			// пробекаем по именам файлов, вытаскивая первую строчку каждого файла.
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
					$first_line = trim(strip_tags($first_line)); 
				} else {
					$first_line = "Не удалось открыть файл.";
				}
				$linkName = substr($name, 0, -4);
				$resultArr []= ["/function/$linkName/",$first_line];
			}
			return $resultArr;
	}
	public function sortedMenuArr($menuArr){
		$sortedMenuArr =[];
		foreach($menuArr as $menuItem){
			$reg ='#\d*#';
			preg_match($reg, $menuItem, $menuNum);
			$sortedMenuArr [$menuNum[0]]= $menuItem;
		}
		ksort($sortedMenuArr);
		return $sortedMenuArr;
	}

	public function __toString(){
		return $this->menu;
	}

	// public function createMenuOld($menuDir, $menuName = 'menu'){

	// 	// $menuDir - название каталога из которого будет сделано меню.
	// 	// $menuName - заголовок меню

	// 	$dir = $this->dir . $menuDir;

	// 		// Читае в массив имена файлов в указанном каталоге.
	// 		$files = (array_slice(scandir($dir),2));
	// 		$result = "<ol><h4>$menuName</h4>";
	// 		foreach($files as $name){
	// 			$filename = $dir . '/' . $name;
	// 			$first_line = '';
	// 			$handle = fopen($filename, 'r');

	// 			if ($handle) {
	// 				// Читаем одну строку
	// 				$first_line = fgets($handle);
					
	// 				// Закрываем файл
	// 				fclose($handle);

	// 				// Выводим первую строчку (может содержать \n в конце, которое можно убрать с помощью trim())
	// 				$first_line = trim(strip_tags($first_line)); 
	// 			} else {
	// 				$first_line = "Не удалось открыть файл.";
	// 			}

	// 			$result .= "<li><a href='/function/$name/'>$first_line</a></li>";
				
	// 		}
	// 		$result .= "</ol>";
	// 		$this->menu = $result;
	// 		return $this;
	// }



}