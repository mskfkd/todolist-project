
<?php
require_once(dirname(__FILE__). "./../models/Todo.php");
require_once(dirname(__FILE__). "./../validations/TodoValidation.php");


class BaseController
{

	public function index()
	{
		$page = Todo::pagenation();
		$range = Todo::pagenum( $page );
		$todos = Todo::findAll();

		return [ $todos, $page, $range ];

	}

	public function detail()
	{

		$todo_id = $_GET["todo_id"];

		$todo = Todo::findById($todo_id);

		return $todo;
	}

	public function getData($params)
	{

		return $params;
	}

	public function new()
	{
		session_start();


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
		session_start();

		$params = [
			"todoId"	=> $_GET["todoId"],
			"title"			 => $_GET["title"],
			"detail"		=> $_GET["detail"],
			"endAt"		=> $_GET["end_at"],
		];

		return $params;

	}

	public function update() {


		$params = [
			"todoId" => $_POST["todoId"],
			"title"	 => $_POST["title"],
			"detail" => $_POST["detail"],
			"endAt"  => $_POST["end_at"],
		];

		$validator = new TodoValidation;
		$validate = $validator->checkTodo($params);

		if ($validate === false) {
			session_start();
			$message = $validator->getErrorMessage();
			$_SESSION["errors"] = $message;
			$query = http_build_query($params);

			header("Location:./../../views/todo/edit.php" . "?" . $query);
			exit();
		}

		$validated_data = $validator->getData( $params[ "todoId" ] );

		$todo = new Todo;
		$result = $todo->update($validated_data,$params);

		if ($result === true) {

			header("Location:./../../views/todo/index.php");
			exit();

		} else {

			header("Location:./../../views/todo/edit.php");
			echo "編集に失敗しました。";
			exit();

		}


		return;
	}

	


}
