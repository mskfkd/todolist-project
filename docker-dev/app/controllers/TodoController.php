<?php
require_once(dirname(__FILE__). "./../models/Todo.php");
require_once(dirname(__FILE__). "./../validations/TodoValidation.php");
require_once(dirname(__FILE__). "/BaseController.php");
require_once(dirname(__FILE__). "./../services/ServiceTodo.php");
require_once(dirname(__FILE__). "./../views/error/404.php");


class TodoController extends BaseController
{

	public function index( $params )
	{
		$params = [
			'title' => $_GET[ 'title' ],
			'deadline1' => $_GET[ 'deadline1' ],
			'deadline2' => $_GET[ 'deadline2' ],
			'selectstatus' => $_GET[ 'selectstatus' ],
		];

		$result = ServiceTodo::paginate( $params );	
		// list( $todos, $page, $range ) = ServiceTodo::paginate();	
    // error_log(print_r( $result, true));

		// return compact( 'todos', 'page', 'range' );
		return $result;
	}

	public function detail()
	{

		$todo_id = $_GET["todo_id"];

		$todo = Todo::findById($todo_id);

		if ( is_null($todo) === true
			|| $todo === '' ) {

			// header("HTTP/1.1 404 Not Found");
			header( "Location:" . $_SERVER[ 'DOCUMENT_ROOT' ] . "/404.php");
			exit();

		}

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


	


	public function edit() {
		session_start();

		$params = [
			"todoId"	=> $_GET["todoId"],
			"title"			 => $_GET["title"],
			"detail"		=> $_GET["detail"],
			"endAt"		=> $_GET["end_at"],
		];

		if ( is_null( $params[ "todoId" ] ) === true
			|| $params[ "todoId" ] === '' ) {

			// header("HTTP/1.1 404 Not Found");
			header( "Location:" . $_SERVER[ 'DOCUMENT_ROOT' ] . "/404.php");
			exit();

		}

		return $params;

	}


	 public function store() {

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

		$serviceTodo = new ServiceTodo();
		$result = $serviceTodo->store($validated_data);

		if ($result === true) {

			header("Location:./../../views/todo/index.php");
			exit();
		} else {

			header("Location:./../../views/todo/new.php");
			echo "新規作成に失敗しました。";
			exit();
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

		$serviceTodo = new ServiceTodo();
		$result = $serviceTodo->update($validated_data);
		
		if ($result === true) {

			header("Location:./../../views/todo/index.php");
			exit();

		} else {

			header("Location:./../../views/todo/edit.php");
			echo "編集に失敗しました。";
			exit();

		}
	 }


}
