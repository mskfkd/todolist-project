<?php

	require( "../config/db.php" );

	class Todo {
		
		public $db;
		public $sql;
		public $result;
		public $dbData;
		public $tableDatas = [];
		public $key;
		public $data;

		public function findAll() {


			try {
			     $this->db = new PDO ( DSN, DB_USERNAME, DB_PASSWORD );
			}catch ( PDOException $e ) {
			     echo "DB接続できません。" . $e->getMessage ();
			     exit;
			}
			
			$this->sql = "SELECT * FROM todos";
			
			$this->result = $this->db->prepare( $this->sql );
			$this->result->execute();
			$this->dbData = $this->result->fetch (PDO::FETCH_ASSOC);
			
			
			
			foreach( $this->dbData as $this->key => $this->data) {
				$this->tableDatas[ $this->key ] = $this->data;
			}
			
			return $this->tableDatas;

		}











	}




















?>
