<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class ApiController extends Controller	{
		
		public function getPage($params) {
			$name = $params['theme'];
			return $this->render("api/$name");
		}
	}
?>