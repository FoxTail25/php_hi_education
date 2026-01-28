<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Cities extends Model {
		public function getCities($CountryId) {
			return $this->findMany("SELECT * FROM cities WHERE country_id=$CountryId");
		}
	}
?>