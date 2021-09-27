<?php

require( "../models/Todo.php" );

class TodoController {
	public function index() {
		$todos = Todo::findAll();
		//var_dump( $todos );

		return $todos;
	}

	public function detail( $todo_id ) {

		$details = Todo::findById( $todo_id );
		var_dump( $todo_id );

		return $details;

	}



}












?>
