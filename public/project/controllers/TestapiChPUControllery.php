<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class TestapiChPUController extends Controller	{
		
		public function getPage($params) {
			$name = $params['theme'];
			$n1 = $params['name'];
			$this->layout = 'zero'; // пустой layout
			return $this->render("testapi/$name");
		}
	}
?>