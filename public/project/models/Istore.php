<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Istore extends Model {
		public $tableName = 'istore'; // указываем названи таблицы в которой будут храниться наши данные.
		public function get($id = false){
			// метод обрабатывающий GET запросы. Если указан id то из базы возвращается 1 запись. Если нет то все записи.
			if($id){
				$result = $this->findOne("SELECT * FROM $this->tableName WHERE id ='$id'");
			} else {
				$result = $this->findMany("SELECT * FROM $this->tableName");
			}
			return $result;
		}
		public function post($newProduct){
			// метод обрабатывающий POST запросы. Добавляет новую запись в базу данных
			$result = $this->addOrDelOne("INSERT INTO $this->tableName (name, quantity, price) VALUES ('$newProduct[name]', '$newProduct[quantity]', '$newProduct[price]')");

			if($result){
				$new = json_encode($newProduct);
				return "новый продукт $new успешно добавлен";
			}
			return "возникла ошибка";
		}
		public function put($updateProduct){
			// Метод обрабатывающий PUT запросы. Изменяет запись в базе данных
			$result = $this->addOrDelOne("UPDATE $this->tableName SET name='$updateProduct[name]', quantity = '$updateProduct[quantity]', price= '$updateProduct[price]' WHERE id='$updateProduct[id]'");
			if($result){
				return "продукт с id = $updateProduct[id] успешно изменён";
			}
			return "возникла ошибка";
		}
	
		public function delete($id){
			// Метод обрабатывающий DELETE запросы. 
			$result = $this->addOrDelOne("DELETE FROM $this->tableName WHERE id='$id'");
			if($result){
				return "продукт с id = $id успешно удалён";
			}
			return "возникла ошибка";
		}
    }
?>