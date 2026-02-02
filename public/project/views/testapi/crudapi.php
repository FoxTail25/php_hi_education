<?php
use \Project\Models\Crudcitiesmodel;
$crudApi = new Crudcitiesmodel;

if(isset($_GET['action'])) {
	$answer = '';
	switch($_GET['action']){
		case 'all':
		$answer = $crudApi->getAllCities();
		break;
		case 'get': 
		$answer = $crudApi->getCityById($_GET['id']);
		break;
		case 'del': 
		$answer =  $crudApi->deleteCityById($_GET['id']);
		break;
	}
	echo json_encode($answer);

} else if (isset($_POST['action'])) {
	$answer = '';
	switch($_POST['action']){
		case 'add':
		$data = json_decode($_POST['jsondata'],true);
		$cityName = $data['name'];
		$countryId = $data['countryid'];
		$answer = $crudApi->addCity($cityName, $countryId);
		break;
		
		case 'update':
		$data = json_decode($_POST['jsondata'],true);
		$newCityName = $data['newCityName'];
		$cityId = $data['cityId'];
		$answer = $crudApi->updateCityById($newCityName, $cityId);
		break;
	}
	echo $answer;

} else {
	echo 'Это адрес api, для работы с ним надо отправить GET или POST запрос.';
}



?>