<?php

require_once("./../../config/db.php");

class Todo
{

	public static function findAll()
	{


		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
		} catch (PDOException $e) {
			echo "DB接続できません。" . $e->getMessage();
			exit;
		}

		$sql = "SELECT * FROM todos WHERE user_id = 1";

		$sth = $db->prepare($sql);
		$sth->execute();
		$todos = $sth->fetchAll(PDO::FETCH_ASSOC);




		return $todos;
	}

	public function findById($todo_id)
	{

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "SELECT * FROM todos WHERE id = :id";

			$sth = $db->prepare($sql);
			$sth->bindValue(':id', $todo_id, PDO::PARAM_INT);
			$sth->execute();
			$details = $sth->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			//		     echo "登録されたtodoの詳細が表示できませんでした。" . $e->getMessage ();
			$result = 0;
			return $result;
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

	public function update($params)
	{

		try {
			$db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
			$sql = "UPDATE todos SET title = :title, detail = :detail, end_at = :end_at, updated_at = NOW() WHERE id = :id";
			//$sql = "UPDATE todos SET title = '" . $params[ "title" ] . "',  detail ='" .  $params[ "detail" ] ."', end_at ='" . $params[ "endAt" ]  ."' WHERE id = " . $params[ "todoId" ] . ";";

			$sth = $db->prepare($sql);
			$sth->bindParam(':id', $params["todoId"], PDO::PARAM_INT);
			$sth->bindParam(':title', $params["title"], PDO::PARAM_STR);
			$sth->bindParam(':detail', $params["detail"],  PDO::PARAM_STR);
			$sth->bindParam(':end_at', date("Y-m-d H:i:s", strtotime($params["endAt"])), PDO::PARAM_STR);
			$res = $sth->execute();

		} catch (PDOException $e) {
			$result = 0;
			return $result;
		}


		return $res;
	}
}
