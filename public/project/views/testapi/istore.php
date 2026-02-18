<?php
	use Project\Models\Istore;
	$istore = new Istore;

	$method = $_SERVER['HTTP_X_HTTP_METHOD'];
	switch ($method)  {
			case 'GET':
			if(!isset($id)){
				echo json_encode($istore->get());
			} else {
				echo json_encode($istore->get($id));
			}
			break;
			case 'POST':
				if(isset($_POST['data'])) {
					$productInfo = json_decode($_POST['data'],true);
					echo $istore->post($productInfo);
				} else {
					echo "istore ". $method;
				}
			break;
			case 'PUT':
				$productInfo = json_decode($_POST['data'],true);
				$updateData = array_merge(['id' => $id], $productInfo);
				echo $istore->put($updateData);
			break;
			case 'DELETE':
				// echo "istore ". $method . " $id";
				echo $istore->delete($id);
			break;
		}

?>