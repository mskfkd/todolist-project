<?php
require_once(dirname(__FILE__). "/../models/Todo.php");
require_once( dirname(__DIR__). "/controllers/BaseController.php" );


class ServiceTodo  {

  public function paginate()
  {
    $page = BaseController::getCurrentPage();
    $range = Todo::pagenum( $page );
    $todos = Todo::findAll();

    return [
      'page' => $page,
      'range' => $range,
      'todos' => $todos
    ];


  }

  public function store()
	{

		$params = [
			"userId" => 0,
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
?>