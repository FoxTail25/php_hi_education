<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Istore extends Model {
		public $tableName = 'istore';
		public function get($id = false){
			if($id){
				$result = $this->findOne("SELECT * FROM $this->tableName WHERE id ='$id'");
			} else {
				$result = $this->findMany("SELECT * FROM $this->tableName");
			}
			
			return $result;
		}
		public function post($newProduct){
			// $query = "INSERT INTO users (name, age, salary) VALUES ('user', 30, 1000)";
			$result = $this->addOrDelOne("INSERT INTO $this->tableName (name, quantity, price) VALUES ('$newProduct[name]', '$newProduct[quantity]', '$newProduct[price]')");

			if($result){
				return "новый продукт успешно добавлен";
			}
			return "возникла ошибка";
		}
		public function put($updateProduct){
			$result = $this->addOrDelOne("UPDATE $this->tableName SET name='$updateProduct[name]', quantity = '$updateProduct[quantity]', price= '$updateProduct[price]' WHERE id='$updateProduct[id]'");
			if($result){
				return "продукт с id = $updateProduct[id] успешно изменён";
			}
			return "возникла ошибка";
		}
	
		public function delete($id){
			$result = $this->addOrDelOne("DELETE $this->tableName WHERE id='$id'");
			if($result){
				return "продукт с id = $id успешно удалён";
			}
			return "возникла ошибка";
		}
    }
?>