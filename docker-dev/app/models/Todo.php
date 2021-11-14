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


	public function insert( $title, $detail, $endAt ) {

		try {
		     $db = new PDO ( DSN, DB_USERNAME, DB_PASSWORD );
		     $sql = "INSERT INTO todos ( title, detail, end_at ) VALUES ( :title, :detail, :end_at )";
		     var_dump( $title );
		     var_dump( $detail );
		     var_dump( $endAt );
		
		     $sth = $db->prepare( $sql );
		     $stmt = [
			     	':title' => $title, 
			     	':detail' => $detail, 
				':end_at' => $endAt 
		     	];
		     $res = $sth->execute( $stmt );

		     $db = null;
		     
		}catch ( PDOException $e ) {
		     $result = 0;
		     return $result; 
		}

		return $res;

	}










}




















?>
