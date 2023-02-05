<?php

require_once(dirname(__FILE__). "./../config/db.php" );

class User
{
	public function getAllId() {

		try {
		     $db = new PDO ( DSN, DB_USERNAME, DB_PASSWORD );
		}catch ( PDOException $e ) {
		     echo "DB接続できません。" . $e->getMessage ();
		     exit;
		}
		
		$sql = "SELECT * FROM users";
		
		$sth = $db->prepare( $sql );
		$sth->execute();
		$users = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return $users;

	}

	public function isExistById( $selectUserId ) {
		try {
			$db = new PDO ( DSN, DB_USERNAME, DB_PASSWORD );
		}catch ( PDOException $e ) {
			echo "DB接続できません。" . $e->getMessage ();
			exit;
		}
 
		$sql = "SELECT * FROM users WHERE id = " . $selectUserId;

		$sth = $db->prepare( $sql );
		$sth->execute();
		$users = $sth->fetchAll(PDO::FETCH_ASSOC);
 
		return $users;

	}








}








?>