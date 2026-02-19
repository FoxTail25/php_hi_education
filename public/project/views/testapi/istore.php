<?php
	use Project\Models\Istore;
	$istore = new Istore;

	$method = $_SERVER['HTTP_X_HTTP_METHOD'];
	$answer = ''; // сюда будет записан ответ модели
	switch ($method)  {
		case 'GET':
		if(!isset($id)){
			$answer = $istore->get();
		} else {
			$answer = $istore->get($id);
		}
		break;
		case 'POST':
			$productInfo = json_decode($_POST['data'],true);
			$answer = $istore->post($productInfo);
		break;
		case 'PUT':
			$productInfo = json_decode($_POST['data'],true);
			$updateData = array_merge(['id' => $id], $productInfo);
			$answer = $istore->put($updateData);
		break;
		case 'DELETE':
			$answer = $istore->delete($id);
		break;
	}
	// переводим в json и отправляем ответ модели клиенту
	echo json_encode($answer); 
?>