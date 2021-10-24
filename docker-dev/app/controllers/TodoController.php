<?php

require_once( "./../../models/Todo.php" );

class TodoController {
	public function index() {
		$todos = Todo::findAll();
		//var_dump( $todos );

		return $todos;
	}

	public function detail() {

		//GETパラメータ取得
		$todo_id = $_GET[ "todo_id" ];

		$todo = Todo::findById( $todo_id );
		//var_dump( $todo );

		if( !$todo ) {
		   $todo = 'error'; 
		//   return $todo;
		   header("HTTP/1.1 404 Not Found");
		   include("Location:./../../views/todo/index.php");
		   exit();
		}


		return $todo;

	}



}












?>
