<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class SqlsecureController extends Controller	{
		
		public function getPage($params) {
			$name = $params['theme'];					
			return $this->render("sqlsecure/$name");
		}
	}
?>