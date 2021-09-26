<?php

require( "../config/db.php" );

class Todo {
	
	public static function findAll() {


		try {
		     $db = new PDO ( DSN, DB_USERNAME, DB_PASSWORD );
		}catch ( PDOException $e ) {
		     echo "DB接続できません。" . $e->getMessage ();
		     exit;
		}
		
		$sql = "SELECT * FROM todos WHERE user_id = 1";
		
		$sth = $db->prepare( $sql );
		$sth->execute();
		$todos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		
		
		
		return $todos;

	}

	public function findById( $todo_id ) {


		$sql = "SELECT * FROM todos WHERE id = " . $todo_id;
		
		$sth = $db->prepare( $sql );
		$sth->execute();
		$details = $sth->fetchAll(PDO::FETCH_ASSOC);


		return $details;

	}











}




















?>
