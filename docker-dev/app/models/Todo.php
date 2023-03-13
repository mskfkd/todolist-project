<?php

require_once(dirname(__FILE__). "./../config/db.php");

class Todo
{
	const STATUS_COMPLETE = 2;
	const UPPER_LINIT = 10;
	const UPPER_PAGE_LINIT = 4;
	const MIDDLE_PAGE_LINIT = 3;
	const LOWER_PAGE_LINIT = 2;

	public static function findAll()
	{

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
		} catch (PDOException $e) {
			echo "DB接続できません。" . $e->getMessage();
			exit;
		}

		$sql = "SELECT * FROM todos WHERE user_id = 1 && status_id = 1 LIMIT ?,10";

		$sth = $db->prepare($sql);
		$sth->bindParam(1,$_REQUEST[ 'page' ], PDO::PARAM_INT);
		$sth->execute();
		$todos = $sth->fetchAll(PDO::FETCH_ASSOC);
		error_log($_REQUEST['page']);
		// error_log(print_r($todos,true));

		return $todos;
	}

	public static function countAll() {

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
		} catch (PDOException $e) {
			echo "DB接続できません。" . $e->getMessage();
			exit;
		}

		$sql = "SELECT count(*) FROM todos WHERE user_id = 1 && status_id = 1";

		$sth = $db->query($sql);
		$todos = $sth->fetch(PDO::FETCH_COLUMN);

		return $todos;

	}

	public static function findById($todo_id)
	{

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM todos WHERE id = :id && status_id = 1";

			$sth = $db->prepare($sql);
			$sth->bindValue(':id', $todo_id, PDO::PARAM_INT);
			$sth->execute();
			$details = $sth->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return false;
		}

		return $details;
	}


	public function insert($passToTodo) {

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "INSERT INTO todos ( user_id, title, detail, end_at, created_at ) VALUES ( :status_id, :user_id, :title, :detail, :end_at, NOW() )";


			$sth = $db->prepare($sql);
			$sth->bindParam(':status_id', 1, PDO::PARAM_INT);
			$sth->bindParam(':user_id', $passToTodo["userId"], PDO::PARAM_INT);
			$sth->bindParam(':title', $passToTodo["title"], PDO::PARAM_STR);
			$sth->bindParam(':detail', $passToTodo["detail"],  PDO::PARAM_STR);
			$sth->bindParam(':end_at', date("Y-m-d H:i:s", strtotime($passToTodo["endAt"])), PDO::PARAM_STR);
			$res = $sth->execute();
		} catch (PDOException $e) {
			return false;
		}

		return $res;
	}

	public function update($validates_data,$params)
	{

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "UPDATE todos SET title = :title, detail = :detail, end_at = :end_at, updated_at = NOW() WHERE id = :id";

			$db->beginTransaction();

			$sth = $db->prepare($sql);
			$sth->bindParam(':id', $validates_data["todoId"], PDO::PARAM_INT);
			$sth->bindParam(':title', $params["title"], PDO::PARAM_STR);
			$sth->bindParam(':detail', $params["detail"],  PDO::PARAM_STR);
			$sth->bindParam(':end_at', date("Y-m-d H:i:s", strtotime($params["endAt"])), PDO::PARAM_STR);

			$res = $sth->execute();

			if( $res ) {

				$db->commit();

			}

		} catch (PDOException $e) {
			$db->rollBack();
			return false;

		}


		return $res;
	}

	public function delete($validates_data) {

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "DELETE FROM todos WHERE id = :id";

			$db->beginTransaction();

			$sth = $db->prepare($sql);
			$sth->bindValue(':id', $validates_data["id"], PDO::PARAM_INT);

			$res = $sth->execute();

			if( $res ) {

				$db->commit();

			}

		} catch (PDOException $e) {
			$db->rollBack();
			return false;

		}


		return $res;



	}

	public function updateStatus($validates_data) {

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "UPDATE todos SET status_id = :status_id,  updated_at = NOW() WHERE id = :id";

			$db->beginTransaction();

			$sth = $db->prepare($sql);
			$sth->bindParam(':id', $validates_data["id"], PDO::PARAM_INT);
			$sth->bindValue(':status_id', self::STATUS_COMPLETE);

			$res = $sth->execute();

			if( $res ) {

				$db->commit();
				return true;

			}

		} catch (PDOException $e) {
			$db->rollBack();
			return false;

		}

	}

	
	
	public function pagenum( $page ) {
		
		$data = Todo::countAll();

		$maxPage = ceil( $data / self::UPPER_LINIT );

		if ( $page == 1 || $page == $maxPage ) {
			$range = self::UPPER_PAGE_LINIT;
		} elseif( $page == 2 || $page == $maxPage - 1 ) {
			$range = self::MIDDLE_PAGE_LINIT;
		} else {
			$range = self::LOWER_PAGE_LINIT;
		}

		$result = [
			'maxPage' => $maxPage,
			'range' => $range
		];

		return $result;
	}

	public function findtodo( $params, $content ) {
		$results = [];		

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM todos";

			$sth = $db->prepare($sql . $content);
			foreach( $params as $param ) {
				if( !empty($param[ 'title' ]) ) {
					$sth->bindParam( ':title', $param[ 'title' ], PDO::PARAM_STR);
				}

				if( !empty($param[ 'deadline1' ]) 
					&& !empty($param[ 'deadline2' ]) ) {
					$sth->bindParam( ':deadline1', $param[ 'deadline1' ], PDO::PARAM_STR);
					$sth->bindParam( ':deadline2', $param[ 'deadline2' ], PDO::PARAM_STR);
				}
				
				if( !empty($param[ 'selectstatus' ]) ) {
					$sth->bindParam( ':status_id', $param[ 'selectstatus' ], PDO::PARAM_STR);
				}

			}
			$sth->execute();
			$results = $sth->fetch(PDO::FETCH_ASSOC);

		} catch (PDOException $e) {
			return false;
		}

		return $results;
	}





}