<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Crudcitiesmodel extends Model {
		public function getAllCities() {
			return $this->findMany("SELECT * FROM cities");
		}
		public function getCityById($cityId) {
			return $this->findOne("SELECT * FROM cities WHERE id=$cityId");
		}
		public function addCity($cityName, $countryId) {
			return $this->addOrDelOne("INSERT INTO cities SET name='$cityName', country_id='$countryId'");
		}
		public function deleteCityById($cityId) {
			return $this->addOrDelOne("DELETE FROM cities WHERE id='$cityId'");
		}
		public function updateCityById($newCityName, $cityId) {
			return $this->addOrDelOne("UPDATE cities SET name='$newCityName' WHERE id=$cityId");
		}

	}
?>