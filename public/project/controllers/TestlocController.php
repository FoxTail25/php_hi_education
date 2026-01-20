<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class TestlocController extends Controller	{
		
		public function getPage($params) {
			$this->layout = 'zero';
			$name = $params['theme'];
			return $this->render("testloc/$name");
		}
	}
?>