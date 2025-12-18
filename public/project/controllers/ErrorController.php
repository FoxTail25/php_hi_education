<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class ErrorController extends Controller
	{
		public function notFound() {
			$this->title = 'Page not found';

			$this->layout = 'notfound';
			
			return $this->render('error/notFound');
		}
	}
