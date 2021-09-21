<?php

require( "../models/Todo.php" );

class TodoController {
	public function index() {
		$todos = Todo::findAll();
		//var_dump( $todos );

		return $todos;
	}



}












?>
