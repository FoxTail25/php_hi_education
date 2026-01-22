<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class TestapiController extends Controller	{
		
		public function getPage($params) {
			$name = $params['theme'];
			$this->layout = 'zero'; // пустой layout
			return $this->render("testapi/$name");
		}
	}
?>