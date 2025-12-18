<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class JsonController extends Controller	{
		public function intro()	{
			return $this->render('json/intro');
		}
		public function data_in_json()	{
			return $this->render('json/data_in_json');
		}
		public function data_from_json()	{
			return $this->render('json/data_from_json');
		}
		public function obj_from_json()	{
			return $this->render('json/obj_in_json');
		}
		public function obj_from_json_in_associative_array()	{
			return $this->render('json/obj_in_json');
		}
	}
?>