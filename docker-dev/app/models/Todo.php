<?php

require_once(dirname(__FILE__). "./../config/db.php");

class Todo
{
	const STATUS_COMPLETE = 2;

	public static function findAll()
	{


		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
		} catch (PDOException $e) {
			echo "DB接続できません。" . $e->getMessage();
			exit;
		}

		$sql = "SELECT * FROM todos WHERE user_id = 1 && status = 1";

		$sth = $db->prepare($sql);
		$sth->execute();
		$todos = $sth->fetchAll(PDO::FETCH_ASSOC);




		return $todos;
	}

	public static function findById($todo_id)
	{

		//@@@@ここでなぜかidがvalidationで受け取ったidと異なる値で渡される
		// error_log( "findById" . $todo_id);
		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM todos WHERE id = :id && status = 1";

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
			$sql = "INSERT INTO todos ( user_id, title, detail, end_at, created_at ) VALUES ( :user_id, :title, :detail, :end_at, NOW() )";


			$sth = $db->prepare($sql);
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
			$sql = "UPDATE todos SET status = :status,  updated_at = NOW() WHERE id = :id";

			$db->beginTransaction();

			$sth = $db->prepare($sql);
			$sth->bindParam(':id', $validates_data["id"], PDO::PARAM_INT);
			$sth->bindValue(':status', self::STATUS_COMPLETE);

			$res = $sth->execute();

			if( $res ) {

				$db->commit();

			}

		} catch (PDOException $e) {
			$db->rollBack();
			return false;

		}

	}


}
