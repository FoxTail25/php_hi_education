<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class TestapiController extends Controller	{
		
		public function getPage($params) {
			$this->layout = 'zero'; // пустой layout

			$name = $params['theme'];					
			
			return $this->render("testapi/$name");
		}

		public function getLeap($params) {
			$this->layout = 'zero'; // пустой layout

			$year = $params['year'];
			
			return $this->render("testapi/leap", ['year'=> $year]);
		}
		
		public function getDiff($params) {
			$this->layout = 'zero'; // пустой layout

			$year1 = $params['year1'];
			$year2 = $params['year2'];
			
			return $this->render("testapi/diff", ['year1'=> $year1, 'year2'=> $year2]);
		}
	}
?>