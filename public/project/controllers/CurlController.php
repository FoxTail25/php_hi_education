<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class CurlController extends Controller	{
		
		public function getPage($params) {
			$name = $params['theme'];
			return $this->render("curl/$name");
		}
	}
?>