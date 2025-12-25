<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class FunctionController extends Controller	{
		
		public function getPage($params) {
			$name = $params['theme'];
			return $this->render("function/$name");
		}
	}
?>