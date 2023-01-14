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

  public function store($data)
	{
		
		$result = Todo::insert($data);

		if ($result === true) {

			return true;

		} else {

			return false;
		}

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