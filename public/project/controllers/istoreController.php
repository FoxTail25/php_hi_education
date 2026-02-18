<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class IstoreController extends Controller	{
		
		public function product() {
			$this->layout = 'zero'; // пустой layout
			
			return $this->render("testapi/istore");
		}
		public function ProductById($params) {
			$this->layout = 'zero'; // пустой layout

			$id = $params['id'];					
			
			return $this->render("testapi/istore", ['id' => $id]);
		}

	}
?>