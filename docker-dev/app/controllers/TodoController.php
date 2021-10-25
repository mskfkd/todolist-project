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
		   header("Location:./../../views/error/404.php");
		   exit();
		}


		return $todo;

	}




}












?>
