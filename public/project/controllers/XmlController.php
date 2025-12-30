<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class XmlController extends Controller	{
		
		public function getPage($params) {
			$name = $params['theme'];
			return $this->render("xml/$name");
		}
	}
?>