<?php

	class Todo {

		public function findAll() {


			// データベースに接続
			try {
			     $db = new PDO ( 'mysql:host=127.0.0.1:3306;dbname=todolist;charset=utf8', 'misaki', 'misaki' );
			}catch ( PDOException $e ) {
			     echo "DB接続できません。" . $e->getMessage ();
			     exit;
			}
			
			$sql = "SELECT * FROM todos";
			
			$result = $db->prepare( $sql );
			$result->execute();
			$dbData = $result->fetch (PDO::FETCH_ASSOC);
			
			
			
			$tableDatas = [];
			
			foreach( $dbData as $data) {
				$tableDatas[] = $data;
			}
			
			return $tableDatas;

		}











	}




















?>
