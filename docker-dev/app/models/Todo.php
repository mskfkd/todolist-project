<?php

	require( "../config/db.php" );

	class Todo {
		
		public $tableDatas = [];

		public function findAll() {


			try {
			     $db = new PDO ( DSN, DB_USERNAME, DB_PASSWORD );
			}catch ( PDOException $e ) {
			     echo "DB接続できません。" . $e->getMessage ();
			     exit;
			}
			
			$sql = "SELECT * FROM todos WHERE id = 1";
			
			$sth = $db->prepare( $sql );
			$sth->execute();
			$todos = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			
			
			foreach( $todos as $key => $data) {
				$this->tableDatas[ $key ] = $data;
			}
			
			return $this->tableDatas;

		}











	}




















?>
