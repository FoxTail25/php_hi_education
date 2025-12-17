<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class IndexController extends Controller	{
		public function hi()	{
			// echo 'Hello Pasha from PHP';
			return $this->render('index/hello');
		}
	}
?>