<?php

require_once( "./../../models/Todo.php" );
require_once( "./../../validations/TodoValidation.php" );

class TodoController {
	public function index() {
		$todos = Todo::findAll();

		return $todos;
	}

	public function detail() {

		//GETパラメータ取得
		$todo_id = $_GET[ "todo_id" ];

		$todo = Todo::findById( $todo_id );

//		if( !$todo ) {
//		   $todo = 'error'; 
//		   header("Location:./../../views/error/404.php");
//		   exit();
//		}


		return $todo;

	}

	public function getData( $params ){
	
		return $params;	
	
	}	

	public function new() {
		session_start();

		$params = [
			"userId" => $_GET[ "user_id" ],
			"title"	 => $_GET[ "title" ],
			"detail" => $_GET[ "detail" ],
			"endAt"  => $_GET[ "end_at" ],
		];

		return $params;

	}


	public function store() {
		session_start();

		$params = [
			"userId" => $_POST[ "user_id" ],
			"title"	 => $_POST[ "title" ],
			"detail" => $_POST[ "detail" ],
			"endAt"  => $_POST[ "end_at" ],
		];

		$validator = new Todovalidation;
		$validate = $validator->postCheck( $params );

		if( $validate === false ) {

		       $_GET[ "user_id" ] = $params[ "userId" ];
		       $_GET[ "title" ] = $params[ "title" ];
		       $_GET[ "detail" ] = $params[ "detail" ];
		       $_GET[ "end_at" ] = $params[ "endAt" ];

		       $params = [
		      		"userId"  => $_GET[ "user_id" ],
		      		"title"   => $_GET[ "title" ],
		      		"deitail" => $_GET[ "detail" ],
		      		"endAt"   => $_GET[ "end_at" ],
		       ];
					 $convert = http_build_query( $params );

			header("Location:./../../views/todo/new.php" . "?" . $convert );
			exit();
		}


		$validated_data = $this->getData( $params );
		$result = Todo::insert( $validated_data );

		if( $result === true ) {
			header("Location:./../../views/todo/index.php");
			exit();
		}else {
			header("Location:./../../views/todo/new.php");
			exit();
		}


		return;


	}


}












?>
