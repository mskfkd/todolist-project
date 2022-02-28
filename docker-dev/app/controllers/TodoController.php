<?php
ini_set("display_errors", 1);
require_once("./../../models/Todo.php");
require_once("./../../validations/TodoValidation.php");

class TodoController
{
	public function index()
	{
		$todos = Todo::findAll();

		return $todos;
	}

	public function detail()
	{

		//GETパラメータ取得
		$todo_id = $_GET["todo_id"];

		$todo = Todo::findById($todo_id);

		//		if( !$todo ) {
		//		   $todo = 'error'; 
		//		   header("Location:./../../views/error/404.php");
		//		   exit();
		//		}


		return $todo;
	}

	public function getData($params)
	{

		return $params;
	}

	public function new()
	{
		session_start();

		//		if( isset( $_GET[ "user_id" ]) === true ) {
		//			$params[ "userId" ] = $_GET[ "user_id" ];
		//		}
		//		else {
		//			echo "ユーザーIDを入力してください。";
		//		}

		$params = [
			"title"	 => $_GET["title"],
			"detail" => $_GET["detail"],
			"endAt"  => $_GET["end_at"],
		];

		return $params;
	}


	public function store()
	{

		$params = [
//			"userId" => $_POST["user_id"],
			"userId" => 1,
			"title"	 => $_POST["title"],
			"detail" => $_POST["detail"],
			"endAt"  => $_POST["end_at"],
		];

		$validator = new Todovalidation;
		$validate = $validator->postCheck($params);

		if ($validate === false) {
			session_start();
			//バリデーションクラスからエラーメッセージを取得
			$message = $validator->getErrorMessage();
			//セッションに保存
			$_SESSION["message"] = $message;
			$query = http_build_query($params);

			header("Location:./../../views/todo/new.php" . "?" . $query);
			//	return $_SESSION[ "message" ];
			exit();
		}

		$validated_data = $this->getData($params);
		$result = Todo::insert($validated_data);

		if ($result === true) {

			header("Location:./../../views/todo/index.php");
			exit();
		} else {

			header("Location:./../../views/todo/new.php");
			echo "新規作成に失敗しました。";
			exit();
		}


		return;
	}


	public function edit() {

	}

	public function update() {

	}




}
