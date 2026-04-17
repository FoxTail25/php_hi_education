<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class PdoController extends Controller	{
		
		public function getPage($params) {
			$name = $params['theme'];					
			return $this->render("pdo/$name");
		}
	}
?>