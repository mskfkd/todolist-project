<?php

require_once( "./../../config/db.php" );

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

		try {
		     $db = new PDO ( DSN, DB_USERNAME, DB_PASSWORD );
		}catch ( PDOException $e ) {
		     echo "DB接続できません。" . $e->getMessage ();
		     exit;
		}

		$sql = "SELECT * FROM todos WHERE id = :id";
		
		$sth = $db->prepare( $sql );
		$sth->bindValue( ':id', $todo_id, PDO::PARAM_INT );
		$sth->execute();
		$details = $sth->fetchAll(PDO::FETCH_ASSOC);

//var_dump($details);

		return $details;

	}











}




















?>
