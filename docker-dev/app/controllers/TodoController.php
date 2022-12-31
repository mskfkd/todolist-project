<?php
require_once(dirname(__FILE__). "./../models/Todo.php");
require_once(dirname(__FILE__). "./../validations/TodoValidation.php");
require_once(dirname(__FILE__). "/BaseController.php");
require_once(dirname(__FILE__). "./../services/ServiceTodo.php");
require_once(dirname(__FILE__). "./../views/error/404.php");


class TodoController extends BaseController
{

	public function index()
	{
		// list( $todos, $page, $range ) = ServiceTodo::paginate();	
		$result = ServiceTodo::paginate();	
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

	

	public function search( $params ) {

		$params = [
			'title' => $_POST[ 'title' ],
			'deadline' => $_POST[ 'deadline' ],
			'selectstatus' => $_POST[ 'selectstatus' ],
		];
		error_log(print_r($params, true));

		$todo = new Todo();

		if( isset( $params[ 'title' ] ) ) {
			
			$res = $todo->findtitle( $params[ 'title' ] );
			return $res;

		} elseif ( isset( $params[ 'deadline' ] ) ) {

			$res = $todo->finddeadline( $params[ 'deadline' ] );
			return $res;

		}elseif( isset( $params[ 'selectstatus' ] ) ) {

			$res = $todo->findstatus( $params[ 'selectstatus' ] );
			return $res;

		}



	 }




}
