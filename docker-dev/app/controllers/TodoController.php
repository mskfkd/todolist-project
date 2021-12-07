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

	public function new() {

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
		var_dump( $validate);

		if( $validate === false ) {
		       $_SESSION[ "user_id" ] = $passTodo[ "userId" ];
		       $_SESSION[ "title" ] = $passTodo[ "title" ];
		       $_SESSION[ "detail" ] = $passTodo[ "detail" ];
		       $_SESSION[ "end_at" ] = $passTodo[ "endAt" ];
		       $params = [
		      		"userId"  => $_SESSION[ "user_id" ],
		      		"title"   => $_SESSION[ "title" ],
		      		"deitail" => $_SESSION[ "detail" ],
		      		"endAt"   => $_SESSION[ "end_at" ],
		       ];
		       return $params;
									
			header("Location:./../../views/todo/new.php");
			exit();
		}


		$validated_data = $validator->getData( $params );
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
