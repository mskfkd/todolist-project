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

		$params = [
			"userId" => $_POST[ "user_id" ],
			"title"	 => $_POST[ "title" ],
			"detail" => $_POST[ "detail" ],
			"endAt"  => $_POST[ "end_at" ],
		];

		$validator = new Todovalidation;
		$validate = $validator->postCheck( $params );

		if( $validate === false ) {
			header("Location:./../../views/todo/new.php");
			exit();
		}


		$validated_data = $validator->getData( $params );
		$result = Todo::insert( $validated_data );
		var_dump( $result );

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
