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
		     $sql = "SELECT * FROM todos WHERE id = :id";
		
		     $sth = $db->prepare( $sql );
		     $sth->bindValue( ':id', $todo_id, PDO::PARAM_INT );
		     $sth->execute();
		     $details = $sth->fetch(PDO::FETCH_ASSOC);
		}catch ( PDOException $e ) {
//		     echo "登録されたtodoの詳細が表示できませんでした。" . $e->getMessage ();
		     $result = 0;
		     return $result; 
		}



		return $details;

	}



	public function insert( $passToTodo ) {

		try {
		     $db = new PDO ( DSN, DB_USERNAME, DB_PASSWORD );
		     $sql = "INSERT INTO todos ( user_id, title, detail, end_at, created_at ) VALUES ( :user_id, :title, :detail, :end_at, NOW() )";
		     
		
		     $sth = $db->prepare( $sql );
		     $sth->bindParam(':user_id', $passToTodo[ "userId" ], PDO::PARAM_INT);
		     $sth->bindParam(':title', $passToTodo[ "title" ], PDO::PARAM_STR);
		     $sth->bindParam(':detail', $passToTodo[ "detail" ],  PDO::PARAM_STR);
		     $sth->bindParam(':end_at', date("Y-m-d H:i:s", strtotime( $passToTodo[ "endAt" ] )), PDO::PARAM_STR);
		     $res = $sth->execute();


		     
		}catch ( PDOException $e ) {
		     $result = false;
		     return $result; 
		}

		return $res;

	}


}
















?>
