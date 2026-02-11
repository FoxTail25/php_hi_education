<?php
	namespace Project\Models;
	use \Core\Model;
	
	class TokenWork extends Model {
		public function checkToken($token){
			$result = $this->findOne("SELECT * FROM user_token WHERE token ='$token'");
			return $result;
		}
		public function checkCount($tokenId){
			$result = $this->findOne("SELECT * FROM query_count WHERE token_id='$tokenId'");
			return $result;
		}
		public function addTokenCount($tokenId){
			$date = date('Y-m-d');
			// $query = "INSERT INTO users (name, age, salary) VALUES ('user', 30, 1000)";
			$result = $this->addOrDelOne("INSERT INTO query_count (token_id, querydate, count) VALUES ('$tokenId', '$date', '1')");
			return $result;
		}
		public function updateTokenCount($tokenId, $count, $dateNow){
			
			$result = $this->addOrDelOne("UPDATE query_count SET count='$count', querydate = '$dateNow' WHERE token_id=$tokenId");
			return $result;
		}
    }
?>