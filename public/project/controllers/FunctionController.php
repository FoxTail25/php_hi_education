<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class FunctionController extends Controller	{
		public function test($params) {
			$name = substr($params['theme'],0,-4);
			return $this->render("function/$name");
		}
	}
?>