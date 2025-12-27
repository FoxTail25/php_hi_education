<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class JsonController extends Controller	{
		
		public function getPage($params) {
			$name = $params['theme'];
			return $this->render("json/$name");
		}
	}
?>