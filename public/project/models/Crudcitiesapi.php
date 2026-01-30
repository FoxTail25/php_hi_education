<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Crudcitiesapi extends Model {
		public function getAllCities() {
			return $this->findMany("SELECT * FROM cities");
		}
		public function getCityById($CityId) {
			return $this->findOne("SELECT * FROM cities WHERE id=$CityId");
		}
		public function addCity($cityName, $countryId) {
			return $this->addOne("INSERT INTO cities SET name='$cityName', country_id='$countryId'");
		}
		// public function deleteCityById($cityId) {
		// 	return $this->addOne("DELETE FROM cities WHERE id=$CityId");
		// }

	}
?>