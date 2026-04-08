<?php
	namespace Project\Models;
	use \Core\Model;
	
	class SqlSec extends Model {

		private static $linksec;
		
		public function __construct() {

			parent::__construct(); // выполняем родительский конструктор

			// т.к. в родительском кланссе $link задан private, мы не можем использовать его в дочернем классе и задаем его заново 

			if (!self::$linksec) { // если свойство не задано, то подключаемся 
				self::$linksec = mysqli_connect(DB_HOST, DB_USER, DB_PASS, 
					DB_NAME); 
				mysqli_query(self::$linksec, "SET NAMES 'utf8'");
			}
			
			
		}

		public function getUser($login, $pass) {
			$answer = $this->findOne("SELECT * FROM sec_users WHERE login='$login' and password='$pass'");
            if($answer) {
                return 'прошел авторизацию';
            } 
            return 'не авторизован';            
            
		}
		public function getUserSec($login, $pass) {
			$login =mysqli_real_escape_string(self::$linksec, $login);
			$pass =mysqli_real_escape_string(self::$linksec, $pass);
			$answer = $this->findOne("SELECT * FROM sec_users WHERE login='$login' and password='$pass'");

			if($answer) {
				return 'прошел авторизацию';
			} 
			return 'не авторизован';             
            
		}

	}
?>